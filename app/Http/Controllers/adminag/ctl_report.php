<?php

namespace App\Http\Controllers\adminag;

use App\repositories\repo_agent;
use App\repositories\repo_agent_oplog;
use App\repositories\repo_member_active_data;
use App\repositories\repo_member_increase_data;
use App\repositories\repo_member_online_data;
use App\repositories\repo_member_retention_data;
use App\repositories\repo_order_transfer;
use App\repositories\repo_user;
use App\services\serv_member_active_data;
use App\services\serv_member_retention_data;
use App\services\serv_util;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ctl_report extends Controller
{
    private $repo_member_active_data;
    private $repo_member_increase_data;
    private $repo_member_retention_data;
    private $repo_member_online_data;
    private $repo_agent_oplog;
    private $repo_agent;
    private $repo_user;
    private $repo_order_transfer;
    private $serv_member_active_data;
    private $serv_util;
    private $serv_member_retention_data;
    private $today;

    public function __construct(
        repo_member_active_data $repo_member_active_data,
        repo_member_increase_data $repo_member_increase_data,
        repo_member_retention_data $repo_member_retention_data,
        repo_agent_oplog $repo_agent_oplog,
        repo_member_online_data $repo_member_online_data,
        repo_agent $repo_agent,
        repo_user $repo_user,
        repo_order_transfer $repo_order_transfer,
        serv_member_active_data $serv_member_active_data,
        serv_util $serv_util,
        serv_member_retention_data $serv_member_retention_data
    )
    {
        parent::__construct();
        $this->repo_member_active_data = $repo_member_active_data;
        $this->repo_member_increase_data = $repo_member_increase_data;
        $this->repo_member_retention_data = $repo_member_retention_data;
        $this->repo_agent_oplog = $repo_agent_oplog;
        $this->repo_member_online_data = $repo_member_online_data;
        $this->repo_agent = $repo_agent;
        $this->repo_user = $repo_user;
        $this->repo_order_transfer = $repo_order_transfer;
        $this->serv_member_active_data = $serv_member_active_data;
        $this->serv_util = $serv_util;
        $this->serv_member_retention_data = $serv_member_retention_data;
        $this->today = date('Y/m/d');
    }

    /**
     * 获取用户活跃数据列表, 目前改成实时统计
     * @version 1.0.0
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function member_active_list(Request $request)
    {
        $page_size  = $request->input('page_size', $this->repo_member_active_data->page_size);
        $page       = $request->input('page', 1);
        $date_start = $request->input('date_start', '');
        $date_end   = $request->input('date_end', '');
        $date_start = empty($date_start) ? '2019/01/01' : $date_start;
        $date_end = empty($date_end) ? date('Y/m/d') : $date_end;

        //更新昨天起数据
        if ($page == 1)
        {
            $this->serv_member_active_data->generate_data(date('Y/m/d', strtotime('-30 day')));
        }

        $conds = [
            'agent_id'      => $this->pid,
            'date_start'    => $date_start,
            'date_end'      => $date_end,
            'page_size'     => $page_size, //每页几条
            'page'          => $page, //第几页
            'order_by'      => ['date', 'desc'],
            'count'         => 1, //是否返回总条数
        ];
        $rows = $this->repo_member_active_data->get_list($conds);
        $total_page = ceil($rows['total'] / $page_size);

        //获取代理信息
        $agents = $this->repo_agent->lists([
            'fields'    => ['id', 'realname'],
            'index'     => 'id',
            'where'     => [
                ['id', '=', sql_in($rows['lists'], 'agent_id')],
        ]])->toArray();

        foreach($rows['lists'] as $k => $v) //格式化数据
        {
            $row_plus = [
                'realname' => $agents[$v['agent_id']]['realname'] ?? '',
            ];
            $rows['lists'][$k] = array_merge($v, $row_plus);
        }

        if(get_action() == 'export_member_active')
        {
            $titles = [
                'realname'              => '渠道',
                'member_active_count'   => '总登录用户',
                'd1'                    => '次日',
                'd7'                    => '7日',
                'd30'                   => '30日',
            ];

            $status = $this->serv_util->export_data([
                'page_no'   => $page,
                'rows'      => $rows['lists'],
                'file'      => $request->input('file', ''),
                'fields'    => $request->input('fields', []), //列表所有字段
                'titles'    => $titles, //輸出字段
                'total_page' => $total_page,
            ], $ret_data);
            if($status < 0)
            {
                return res_error($this->serv_util->get_err_msg($status), $status);
            }
            return res_success($ret_data);
        }
        return res_success($rows);
    }

    /**
     * 导出用户活跃数据excel
     * @version 1.0.0
     * @param Request $request
     */
    public function export_member_active(Request $request)
    {
        return $this->member_active_list($request);
    }

    /**
     * 获取用户留存数据列表
     * @version 1.0.0
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function member_retention_list(Request $request)
    {
        $page_size  = $request->input('page_size', $this->repo_member_retention_data->page_size);
        $page       = $request->input('page', 1);
        $date_start = $request->input('date_start', '');
        $date_end   = $request->input('date_end', '');
        $date_start = empty($date_start) ? '2019/01/01' : $date_start;
        $date_end = empty($date_end) ? date('Y/m/d') : $date_end;

        //更新昨天起数据
        if ($page == 1)
        {
            $this->serv_member_retention_data->generate_data(date('Y/m/d', strtotime('-30 day')));
        }

        $conds = [
            'agent_id'      => $this->pid,
            'date_start'    => $date_start,
            'date_end'      => $date_end,
            'page_size'     => $page_size, //每页几条
            'page'          => $page, //第几页
            'order_by'      => ['date', 'desc'],
            'load'          => ['agent_maps'],
            'count'         => 1, //是否返回总条数
        ];
        $rows = $this->repo_member_retention_data->get_list($conds);
        $total_page = ceil($rows['total'] / $page_size);

        if(get_action() == 'export_member_retention')
        {
            $titles = [
                'agent_maps.realname'   => '渠道',
                'member_register_count' => '总注册用户',
                'd1'                    => '次日',
                'd7'                    => '7日',
                'd30'                   => '30日',
            ];

            $status = $this->serv_util->export_data([
                'page_no'   => $page,
                'rows'      => $rows['lists'],
                'file'      => $request->input('file', ''),
                'fields'    => $request->input('fields', []), //列表所有字段
                'titles'    => $titles, //輸出字段
                'total_page' => $total_page,
            ], $ret_data);
            if($status < 0)
            {
                return res_error($this->serv_util->get_err_msg($status), $status);
            }
            return res_success($ret_data);
        }

        return res_success($rows);
    }

    /**
     * 获取用户增长数据列表
     * @version 1.0.0
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function member_increase_list(Request $request)
    {
        $page_size  = $request->input('page_size', $this->repo_member_increase_data->page_size);
        $page       = $request->input('page', 1);
        $date_start = $request->input('date_start', '');
        $date_end   = $request->input('date_end', '');
        $date_start = empty($date_start) ? '2019/01/01' : $date_start;
        $date_end = empty($date_end) ? date('Y/m/d') : $date_end;

        $conds = [
            'fields'    => [
                'date',
                'agent_id',
                DB::raw('SUM(member_count) AS member_count'),
                DB::raw('SUM(member_increase_count) AS member_increase_count'),
            ],
            'agent_id'      => $this->pid,
            'date_start'    => $date_start,
            'date_end'      => $date_end,
            'page_size'     => $page_size, //每页几条
            'page'          => $page, //第几页
            'group_by'      => ['date', 'agent_id'],
            'order_by'      => ['date', 'desc'],
            'load'          => ['agent_maps'],
            'count'         => 1, //是否返回总条数
        ];
        $rows = $this->repo_member_increase_data->get_list($conds);
        return res_success($rows);
    }

    /**
     * 获取用户在线数据列表
     * @version 1.0.0
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function member_online_list(Request $request)
    {
        $page_size  = get_action() == 'export_member_online' ? 100 :
            $request->input('page_size', $this->repo_member_online_data->page_size);
        $page       = $request->input('page', 1);
        $date_start = $request->input('date_start', '');
        $date_end   = $request->input('date_end', '');
        $date_start = empty($date_start) ? '2019/01/01' : $date_start;
        $date_end = empty($date_end) ? date('Y/m/d') : $date_end;

        //获取渠道会员每天每个小时打点数据
        $sub_query = DB::table('member_online_data')
            ->select(
                'agent_id',
                DB::raw("SUM(IF(game1 = 1 OR game2 = 1, member_online_count, 0)) AS member_online_count"),
                DB::raw("DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(create_time, '%Y/%m/%d %H:00'), '+0:00', '+8:00'), '%Y/%m/%d') AS date"),
                DB::raw("DATE_FORMAT(CONVERT_TZ(FROM_UNIXTIME(create_time, '%Y/%m/%d %H:00'), '+0:00', '+8:00'), '%H:00') AS hour"),
        )->groupBy('agent_id', 'create_time');

        //实时聚合统计
        $query = DB::table(DB::raw("({$sub_query->toSql()}) AS sub"))
            ->select(
                DB::raw('date'),
                DB::raw('agent_id'),
                DB::raw('MAX(IF(HOUR(hour) = 0, member_online_count, 0)) AS h0'),
                DB::raw('MAX(IF(HOUR(hour) = 1, member_online_count, 0)) AS h1'),
                DB::raw('MAX(IF(HOUR(hour) = 2, member_online_count, 0)) AS h2'),
                DB::raw('MAX(IF(HOUR(hour) = 3, member_online_count, 0)) AS h3'),
                DB::raw('MAX(IF(HOUR(hour) = 4, member_online_count, 0)) AS h4'),
                DB::raw('MAX(IF(HOUR(hour) = 5, member_online_count, 0)) AS h5'),
                DB::raw('MAX(IF(HOUR(hour) = 6, member_online_count, 0)) AS h6'),
                DB::raw('MAX(IF(HOUR(hour) = 7, member_online_count, 0)) AS h7'),
                DB::raw('MAX(IF(HOUR(hour) = 8, member_online_count, 0)) AS h8'),
                DB::raw('MAX(IF(HOUR(hour) = 9, member_online_count, 0)) AS h9'),
                DB::raw('MAX(IF(HOUR(hour) = 10, member_online_count, 0)) AS h10'),
                DB::raw('MAX(IF(HOUR(hour) = 11, member_online_count, 0)) AS h11'),
                DB::raw('MAX(IF(HOUR(hour) = 12, member_online_count, 0)) AS h12'),
                DB::raw('MAX(IF(HOUR(hour) = 13, member_online_count, 0)) AS h13'),
                DB::raw('MAX(IF(HOUR(hour) = 14, member_online_count, 0)) AS h14'),
                DB::raw('MAX(IF(HOUR(hour) = 15, member_online_count, 0)) AS h15'),
                DB::raw('MAX(IF(HOUR(hour) = 16, member_online_count, 0)) AS h16'),
                DB::raw('MAX(IF(HOUR(hour) = 17, member_online_count, 0)) AS h17'),
                DB::raw('MAX(IF(HOUR(hour) = 18, member_online_count, 0)) AS h18'),
                DB::raw('MAX(IF(HOUR(hour) = 19, member_online_count, 0)) AS h19'),
                DB::raw('MAX(IF(HOUR(hour) = 20, member_online_count, 0)) AS h20'),
                DB::raw('MAX(IF(HOUR(hour) = 21, member_online_count, 0)) AS h21'),
                DB::raw('MAX(IF(HOUR(hour) = 22, member_online_count, 0)) AS h22'),
                DB::raw('MAX(IF(HOUR(hour) = 23, member_online_count, 0)) AS h23'),
                )
            ->groupBy('date', 'agent_id')
            ->orderBy('date', 'desc');

        //筛选
        $query->where('agent_id', '=', $this->pid);
        $date_start and $query->where('date', '>=', $date_start);
        $date_end and $query->where('date', '<=', $date_end);
        //分页
        $page   = max(1, ($page ? $page : 1));
        $offset = ($page - 1) * $page_size;
        $query->limit($page_size)->offset($offset);
        //合并绑定参数
        $query->mergeBindings($sub_query);
        //总条数
        $count = $query->get()->count();
        $member_online_data = $query->get()->toArray();
        $member_online_data = json_decode(json_encode($member_online_data),true); //stdClass转数组
        $rows = [
            'total' => $count,
            'lists' => $member_online_data,
        ];
        $total_page = ceil($rows['total'] / $page_size);

        //获取代理信息
        $agents = $this->repo_agent->lists([
            'fields'    => ['id', 'realname'],
            'index'     => 'id',
            'where'     => [
                ['id', '=', sql_in($rows['lists'], 'agent_id')],
            ]])->toArray();

        foreach($rows['lists'] as $k => $v) //格式化数据
        {
            $row_plus = [
                'realname' => $agents[$v['agent_id']]['realname'] ?? '',
            ];
            $rows['lists'][$k] = array_merge($v, $row_plus);
        }

        if(get_action() == 'export_member_online')
        {
            $titles = [
                'realname'  => '渠道',
                'date'      => '日期',
                'h0'        => '00:00',
                'h1'        => '01:00',
                'h2'        => '02:00',
                'h3'        => '03:00',
                'h4'        => '04:00',
                'h5'        => '05:00',
                'h6'        => '06:00',
                'h7'        => '07:00',
                'h8'        => '08:00',
                'h9'        => '09:00',
                'h10'        => '10:00',
                'h11'        => '11:00',
                'h12'        => '12:00',
                'h13'        => '13:00',
                'h14'        => '14:00',
                'h15'        => '15:00',
                'h16'        => '16:00',
                'h17'        => '17:00',
                'h18'        => '18:00',
                'h19'        => '19:00',
                'h20'        => '20:00',
                'h21'        => '21:00',
                'h22'        => '22:00',
                'h23'        => '23:00',
            ];

            $status = $this->serv_util->export_data([
                'page_no'   => $page,
                'rows'      => $rows['lists'],
                'file'      => $request->input('file', ''),
                'fields'    => $request->input('fields', []), //列表所有字段
                'titles'    => $titles, //輸出字段
                'total_page' => $total_page,
            ], $ret_data);
            if($status < 0)
            {
                return res_error($this->serv_util->get_err_msg($status), $status);
            }
            return res_success($ret_data);
        }
        return res_success($rows);
    }

    /**
     * 导出用户在线数据excel
     * @version 1.0.0
     * @param Request $request
     */
    public function export_member_online(Request $request)
    {
        return $this->member_online_list($request);
    }
}
