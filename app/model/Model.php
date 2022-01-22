<?php

declare(strict_types=1);

namespace app\model;

/**
 * 模型基类
 */
abstract class Model extends \think\Model
{
    /**
     * @return string 获取当前时间
     */
    public function freshTimestamp(): string
    {
        return $this->formatDateTime('Y-m-d H:i:s.u');
    }

    /**
     * 生成主键
     * @return int
     */
    public function generatePk(): int
    {
        $i = rand(0, 99);
        do {
            if (99 == $i) {
                $i = 0;
            }
            $i++;
            $id = date('YmdHis') . str_pad((string)$i, 2, '0', STR_PAD_LEFT);
            $row = !static::where($this->getPk(), '=', $id)->findOrEmpty()->isEmpty();
        } while ($row);
        return (int)$id;
    }
}
