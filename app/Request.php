<?php

declare(strict_types=1);

namespace app;

// 应用请求对象类
use Carbon\Carbon;

class Request extends \think\Request
{
    /**
     * 前端代理服务器IP
     * @var array
     */
    protected $proxyServerIp = [
        '172.17.0.0/16',
        '100.127.0.0/16'
    ];

    /**
     * Retrieve input from the request as a Carbon instance.
     *
     * @param string $key 需要获取的参数名
     * @param string|null $format 时间格式
     * @param string|null $tz 时区
     * @return Carbon|null
     */
    public function date(string $key, string $format = null, string $tz = null): ?Carbon
    {
        if ($this->isNotFilled($key)) {
            return null;
        }
        if (is_null($format)) {
            return \Carbon\Carbon::parse($this->param($key), $tz);
        }
        return \Carbon\Carbon::createFromFormat($format, $this->param($key), $tz);
    }

    /**
     * Determine if the request contains an empty value for an input item.
     *
     * @param array|string $key
     * @return bool
     */
    public function isNotFilled(array|string $key): bool
    {
        $keys = is_array($key) ? $key : func_get_args();
        foreach ($keys as $value) {
            if (!$this->isEmptyString($value)) {
                return false;
            }
        }
        return true;
    }

    /**
     * Determine if the given input key is an empty string for "has".
     *
     * @param string $key
     * @return bool
     */
    protected function isEmptyString(string $key): bool
    {
        $value = $this->param($key);
        return !is_bool($value) && !is_array($value) && trim((string)$value) === '';
    }
}
