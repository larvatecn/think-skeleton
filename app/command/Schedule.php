<?php

declare(strict_types=1);

namespace app\command;

use schedule\console\Command;
use think\console\Input;
use think\console\Output;

/**
 * 任务调度
 */
class Schedule extends Command
{
    protected function configure()
    {
        // 指令配置
        $this->setName('schedule:run')
            ->setDescription('Run the scheduled commands');
    }

    /**
     * 执行
     * @param Input $input
     * @param Output $output
     * @return void
     */
    protected function execute(Input $input, Output $output)
    {
        // 指令输出
        $output->writeln('schedule:run');
        //每天的上午十点和晚上八点执行这个命令
        //$this->command('test')->twiceDaily(10, 20);
        parent::execute($input, $output);
    }
}
