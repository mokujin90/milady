<?php
class CategoryExcludeLogFilter extends CLogFilter
{
      public $categories;

      public function filter(&$logs)
      {
       if (!empty($this->categories)) {
                $exclude = array();
                foreach ($logs as $i => $log) {
                        if (in_array($log[2], $this->categories)) {
                           $exclude[] = $i;
                        }
                }
                foreach ($exclude as $i) {
                        unset($logs[$i]);
                }
       }

      return $logs;
    }
}
?>
