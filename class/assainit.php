<?php

trait Assainit {
    public function assainit($val): string {
        return trim(strip_tags($val));
    }
    
    public function assainitFloat($val): float {
        return floatval($val);
    }
}