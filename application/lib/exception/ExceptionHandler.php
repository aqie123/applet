<?php
/**
 * Created by PhpStorm.
 * User: aqie
 * Date: 2017/5/19 10:52
 */

namespace app\lib\exception;

use Exception;
use think\exception\Handle;
use think\Request;
use think\Log;

/**
 * 自定义异常处理类
 * Class ExceptionHandler
 * @package app\lib\exception
 */
class ExceptionHandler extends Handle
{
    private $code;
    private $msg;
    private $errorCode;
    /**
     * 所有抛出异常经过 render渲染
     * 这里要配置异常处理类
     * @param Exception $e
     * @return \think\Response （返回客户端当前请求的URL路径）
     */
    public function render(Exception $e)
    {
        // return json("-----错误------"); // 测试自定义异常
        if($e instanceof BaseException){
            // 如果是自定义异常
            $this->code = $e->code;
            $this->msg = $e->msg;
            $this->errorCode = $e->errorCode;
        }else{
            // 服务器自身异常
            $this->code = 500;
            $this->msg = "服务器内部错误，不告诉你";
            $this->errorCode = 999;
            // 将服务器错误记录到日志
            $this->recordErrorLog($e);
        }
        // 获取当前请求url
        $request = Request::instance();
        $result = [
            'msg' => $this->msg,
            'error_code' => $this->errorCode,
            'request_url' => $request->url()
        ];
        return json($result,$this->code);
    }
    private function recordErrorLog(Exception $e){
        // 初始化日志
        Log::init([
            'type' => 'File',
            'path' => LOG_PATH,
            'level' => ['error']
        ]);
        // 只对错误做日志记录
        Log::record($e->getMessage(),'error');
    }
}