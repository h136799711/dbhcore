<?php


namespace by\infrastructure\constants;

/**
 * Class BaseErrorCode
 * 系统返回的错误码
 * @package App\Common\constants
 */
class BaseErrorCode
{
    const Success = 0;

    /**
     * 未定义错误
     */
    const Undefined = -1;

    /**
     * 缺少参数
     */
    const Lack_Parameter = 1000;

    /**
     * 404请求资源不存在
     */
    const Not_Found_Resource = 1002;

    /**
     * 无效\非法参数
     */
    const Invalid_Parameter = 1003;

    /**
     * 业务错误
     */
    const Business_Error = 1004;

    /**
     * 接口需要同步、升级
     */
    const Api_Need_Update = 1005;

    /**
     * 发生异常
     */
    const Api_EXCEPTION = 1006;

    /**
     * 请重试
     */
    const Retry = -2;


    /**
     * 接口无权限
     */
    const Api_No_Auth = 1007;

    /**
     * 接口维护中,请稍后再试
     */
    const Api_Under_Maintenance = 1008;


    /**
     * 用户尚未进行邮件认证，请先认证邮件
     */
    const User_Not_Verify_Email = 1112;

    /**
     * 需要登录
     */
    const Api_Need_Login = 1111;


    /**
     * 该接口版本已过期，请用最新接口
     */
    const Api_Service_Is_Deprecated = 9666;

    /**
     * 该接口服务不支持你的APP，请更新新的APP
     */
    const Api_Not_Support_For_Your_App = 9667;

    /**
     * 接口请求次数过多
     */
    const Api_Request_Rate_Limit = 429;


}
