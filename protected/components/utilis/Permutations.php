<?php
    class Permutations {

        public function __construct() {
        }

        function permute($arr) {
            $r = $this->powerPerms($arr);

            $res = array();
            foreach ($r as $permutation) {
                if (count(array_values($permutation)) != 2) {
                    continue;
                }
                $res[] = $permutation;
            }

            return $res;
        }

        function powerPerms($arr) {

            $power_set = $this->power_set($arr);
            $result = array();
            foreach ($power_set as $set) {
                $perms = $this->perms($set);
                $result = array_merge($result, $perms);
            }
            return $result;
        }

        function power_set($in, $minLength = 1) {

            $count = count($in);
            $members = pow(2, $count);
            $return = array();
            for ($i = 0; $i < $members; $i++) {
                $b = sprintf("%0" . $count . "b", $i);
                $out = array();
                for ($j = 0; $j < $count; $j++) {
                    if ($b{$j} == '1')
                        $out[] = $in[$j];
                }
                if (count($out) >= $minLength) {
                    $return[] = $out;
                }
            }

            //usort($return,"cmp");  //can sort here by length
            return $return;
        }

        function factorial($int) {
            if ($int < 2) {
                return 1;
            }

            for ($f = 2; $int - 1 > 1; $f *= $int--)
                ;

            return $f;
        }

        function perm($arr, $nth = null) {
            if ($nth === null) {
                return $this->perms($arr);
            }

            $result = array();
            $length = count($arr);

            while ($length--) {
                $f = $this->factorial($length);
                $p = floor($nth / $f);
                $result[] = $arr[$p];
                $this->array_delete_by_key($arr, $p);
                $nth -= $p * $f;
            }

            return array_merge($result, $arr);
        }

        function perms($arr) {
            $p = array();
            for ($i = 0; $i < $this->factorial(count($arr)); $i++) {
                $p[] = $this->perm($arr, $i);
            }
            return $p;
        }

        function array_delete_by_key(&$array, $delete_key, $use_old_keys = FALSE) {
            unset($array[$delete_key]);

            if (!$use_old_keys) {
                $array = array_values($array);
            }

            return TRUE;
        }

    }
