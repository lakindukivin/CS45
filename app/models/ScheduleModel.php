<?php

class ScheduleModel{
    use Model; 
    protected $table = 'polythenecollection';
    protected $allowedColumns = [
        'area',
        'collection_date',
        'collection_time'
        ];
    protected $primaryKey = 'collection_id';
    
}