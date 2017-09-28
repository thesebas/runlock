<?php

namespace thesebas\runlock;


class Lock {
    /**
     * @var \MongoDB\Collection
     */
    protected $locks;

    public function __construct($config) {
        $mongo = new \MongoDB\Client($config['mongo']['host']);


        $dbName = $config['mongo']['dbName'];
        $collectionName = $config['mongo']['collectionName'];

        $this->locks = $mongo->selectCollection($dbName, $collectionName);
    }

    public function lock($name, $count = 1) {
        $locks = $this->locks;

        $filter = [
            '_id' => $name,
            'count' => ['$lt' => intval($count)]
        ];
        $update = [
            '$inc' => ['count' => 1]
        ];
        $opts = ['upsert' => true];
        try {
            $updateResult = $locks->updateOne($filter, $update, $opts);
            return $updateResult->getUpsertedCount() > 0 || $updateResult->getModifiedCount() > 0;
        } catch (\Exception $e) {
            return false;
        }
    }

    public function unlock($name) {
        $locks = $this->locks;

        $filter = [
            '_id' => $name,
            'count' => ['$gt' => 0]
        ];
        $update = [
            '$inc' => ['count' => -1]
        ];

        $updateResult = $locks->updateOne($filter, $update);

        return $updateResult->getModifiedCount() > 0;
    }

    public function reset($name) {
        $locks = $this->locks;

        $filter = [
            '_id' => $name,
        ];
        $update = [
            '$set' => ['count' => 0]
        ];

        $updateResult = $locks->updateOne($filter, $update);

        return $updateResult->getModifiedCount() > 0;
    }
}