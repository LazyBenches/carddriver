<?php

namespace LazyBench\CardDriver\Driver;

use LazyBench\AliApi\Constant\Constants;
use LazyBench\AliApi\Http\HttpClient;
use LazyBench\BankCard\Driver\BankCardDriver;

/**
 * Author:LazyBench
 * Date:2018/12/21
 */
class Ali implements BankCardDriver
{
    public function two($param)
    {
    }

    public function three($param)
    {
    }

    public function four($param)
    {
        try {
            $request = app('aliApi')->buildRequest(Constants::ALI_BANK_HOST, '/bank4');
            $request->setQuery("acct_name", $param['realName']);
            $request->setQuery("acct_pan", $param['bankCard']);
            $request->setQuery("cert_id", $param['idCard']);
            $request->setQuery("cert_type", '01');
            $request->setQuery("phone_num", $param['mobile']);
            $request->setQuery("needBelongArea", 'true');
            $response = HttpClient::execute($request);
            $statusCode = $response->getHttpStatusCode();
            $data = json_decode($response->getBody(), true);
            if (!$data) {
                throw new \Exception(json_last_error_msg());
            }
            if ($statusCode != 200) {
                throw new \Exception($data['showapi_res_body']['msg'], $statusCode);
            }
            return [
                'code' => $statusCode,
                'msg' => 'success',
                'data' => $data['showapi_res_body']['belong'],
            ];
        } catch (\Exception $e) {
            return [
                'code' => 0,
                'msg' => $e->getMessage() ?: 'fail',
                'data' => [],
            ];
        }
    }
}