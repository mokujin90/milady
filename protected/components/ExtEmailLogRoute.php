<?php
class ExtEmailLogRoute extends CEmailLogRoute
{
    public function collectLogs($logger)
    {
        $logs=$logger->getLogs($this->levels,$this->categories);
        if(!empty($logs))
        {
            if($this->filter!==null)
                Yii::createComponent($this->filter)->filter($logs);
            if(!empty($logs))
                $this->processLogs($logs);
        }
    }
}
?>
