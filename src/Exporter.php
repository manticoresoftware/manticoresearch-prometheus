<?php

class Exporter
{

    private $connection;
    private $metrics = [];
    private $metricNames = [
        'uptime'                => [
            'type'        => 'counter',
            'description' => 'Time in secons since start',
            'name'        => 'uptime_seconds'
        ],
        'connections'           => [
            'type'        => 'gauge',
            'description' => 'Connections count since start',
            'name'        => 'connections_count'
        ],
        'maxed_out'             => [
            'type'        => 'counter',
            'description' => 'Count of maxed_out errors since start',
            'name'        => 'maxed_out_error_count'
        ],
        'version'               => [
            'type'        => 'gauge',
            'description' => 'Manticore Search version',
            'name'        => 'version'
        ],
        'command_search'        => [
            'type'        => 'counter',
            'description' => 'Count of search queries since start',
            'name'        => 'command_search_count'
        ],
        'command_excerpt'       => [
            'type'        => 'counter',
            'description' => 'Count of snippet queries since start',
            'name'        => 'command_excerpt_count'
        ],
        'command_update'        => [
            'type'        => 'counter',
            'description' => 'Count of update queries since ',
            'name'        => 'command_update_count'
        ],
        'command_keywords'      => [
            'type'        => 'counter',
            'description' => 'Count of CALL KEYWORDS since start',
            'name'        => 'command_keywords_count'
        ],
        'command_persist'       => [
            'type'        => 'counter',
            'description' => 'Count of commands initiating a persistent connection since start',
            'name'        => 'command_persist_count'
        ],
        'command_status'        => [
            'type'        => 'counter',
            'description' => 'Count of SHOW STATUS runs since start',
            'name'        => 'command_status_count'
        ],
        'command_flushattrs'    => [
            'type'        => 'counter',
            'description' => 'Count of manual attributes flushes since start',
            'name'        => 'command_flushattrs_count'
        ],
        'command_sphinxql'      => [
            'type'        => 'counter',
            'description' => 'Count of sphinxql API calls since start',
            'name'        => 'command_sphinxql_count'
        ],
        'command_ping'          => [
            'type'        => 'counter',
            'description' => 'Count of pings since start',
            'name'        => 'command_ping_count'
        ],
        'command_delete'        => [
            'type'        => 'counter',
            'description' => 'Count of deletes since start',
            'name'        => 'command_delete_count'
        ],
        'command_insert'        => [
            'type'        => 'counter',
            'description' => 'Count of inserts since start',
            'name'        => 'command_insert_count'
        ],
        'command_replace'       => [
            'type'        => 'counter',
            'description' => 'Count of replaces since start',
            'name'        => 'command_replace_count'
        ],
        'command_commit'        => [
            'type'        => 'counter',
            'description' => 'Count of transaction commits since start',
            'name'        => 'command_commit_count'
        ],
        'command_suggest'       => [
            'type'        => 'counter',
            'description' => 'Count of CALL SUGGEST | CALL_QSUGGEST runs',
            'name'        => 'command_suggest_count'
        ],
        'command_callpq'        => [
            'type'        => 'counter',
            'description' => 'Count of CALL PQ runs',
            'name'        => 'command_callpq_count'
        ],
        'agent_connect'         => [
            'type'        => 'counter',
            'description' => 'Count of connections to agents since start',
            'name'        => 'agent_connect_count'
        ],
        'agent_retry'           => [
            'type'        => 'counter',
            'description' => 'Count of agent connection retries since start',
            'name'        => 'agent_retry_count'
        ],
        'queries'               => [
            'type'        => 'counter',
            'description' => 'Count of queries since start',
            'name'        => 'queries_count'
        ],
        'dist_queries'          => [
            'type'        => 'counter',
            'description' => 'Count of queries to agent-based distributed index since start',
            'name'        => 'dist_queries_count'
        ],
        'workers_total'         => [
            'type'        => 'gauge',
            'description' => 'Number of worker threads',
            'name'        => 'workers_total_count'
        ],
        'workers_clients'       => [
            'type'        => 'gauge',
            'description' => 'Current connections count',
            'name'        => 'current_connections_count'
        ],
        'query_wall'            => [
            'type'        => 'counter',
            'description' => 'Query wall time in seconds since start',
            'name'        => 'query_wall_seconds'
        ],
        'dist_wall'             => [
            'type'        => 'counter',
            'description' => 'Wall time in seconds spent on distributed queries since start',
            'name'        => 'dist_wall_seconds'
        ],
        'dist_local'            => [
            'type'        => 'counter',
            'description' => 'Wall time in seconds spent searching local indexes in distributed queries since start',
            'name'        => 'dist_local_seconds',
        ],
        'dist_wait'             => [
            'type'        => 'counter',
            'description' => 'Time in seconds spent waiting for remote agents in distributed queries since start',
            'name'        => 'dist_wait_seconds'
        ],
        'avg_query_wall'        => [
            'type'        => 'gauge',
            'description' => 'Average query time in seconds since start',
            'name'        => 'avg_query_wall_seconds'
        ],
        'avg_dist_wall'         => [
            'type'        => 'gauge',
            'description' => 'Average distributed query time in seconds since start',
            'name'        => 'avg_dist_wall_seconds'
        ],
        'avg_dist_local'        => [
            'type'        => 'gauge',
            'description' => 'Average time in seconds spent searching local indexes in distributed queries since start',
            'name'        => 'avg_dist_local_seconds'
        ],
        'qcache_max_bytes'      => [
            'type'        => 'gauge',
            'description' => 'The maximum RAM allocated for cached result sets (current value of the variable)',
            'name'        => 'qcache_max_bytes'
        ],
        'qcache_thresh_msec'    => [
            'type'        => 'gauge',
            'description' => 'The minimum wall time (milliseconds) threshold for a query result to be cached (current value of the variable)',
            'name'        => 'qcache_thresh_microseconds'
        ],
        'qcache_ttl_sec'        => [
            'type'        => 'gauge',
            'description' => 'The expiration period (seconds) for a cached result set (current value of the variable)',
            'name'        => 'qcache_ttl_sec'
        ],
        'qcache_cached_queries' => [
            'type'        => 'gauge',
            'description' => 'Number of queries currently in query cache',
            'name'        => 'qcache_cached_queries_count'
        ],
        'qcache_used_bytes'     => [
            'type'        => 'gauge',
            'description' => 'How much (bytes) query cache takes',
            'name'        => 'qcache_used_bytes'
        ],
        'qcache_hits'           => [
            'type'        => 'counter',
            'description' => 'Query cache hits since start',
            'name'        => 'qcache_hits_count'
        ],
        'thread_count'          => [
            'type'        => 'gauge',
            'description' => 'Count of active threads',
            'name'        => 'thread_count'
        ],
        'slowest_thread'        => [
            'type'        => 'gauge',
            'description' => 'Longest current query time in seconds',
            'name'        => 'slowest_thread_seconds'
        ],
        'indexed_documents'     => [
            'type'        => 'gauge',
            'description' => 'Number of indexed documents',
            'name'        => 'indexed_documents_count'
        ],
        'indexed_bytes'         => [
            'type'        => 'gauge',
            'description' => 'Indexed documents size in bytes',
            'name'        => 'indexed_bytes'
        ],
        'ram_bytes'             => [
            'type'        => 'gauge',
            'description' => 'Total size (in bytes) of RAM-resident index part',
            'name'        => 'ram_bytes'
        ],
        'disk_bytes'            => [
            'type'        => 'gauge',
            'description' => 'Total size (in bytes) of all index files',
            'name'        => 'disk_bytes'
        ],
        'killed_rate'           => [
            'type'        => 'gauge',
            'description' => 'Rate of deleted/indexed documents',
            'name'        => 'killed_rate'
        ],
        'disk_chunks'           => [
            'type'        => 'gauge',
            'description' => 'Number of RT index disk chunks',
            'name'        => 'disk_chunks_count'
        ],
        'mem_limit'             => [
            'type'        => 'gauge',
            'description' => 'Actual value (bytes) of rt_mem_limit',
            'name'        => 'mem_limit_bytes'
        ],
        'query_time_1min'       => [
            'type'        => 'gauge',
            'description' => 'Query execution time statistics for last 1 minute; the data is encapsulated in JSON including number of queries and min, max, avg, 95 and 99 percentile values',
            'name'        => 'query_time_1min'
        ],
        'found_rows_1min'       => [
            'type'        => 'gauge',
            'description' => 'Statistics of rows found by queries for last 1 minute. Includes number of queries and min, max, avg, 95 and 99 percentile values',
            'name'        => 'found_rows_1min'
        ],
        'found_rows_total'      => [
            'type'        => 'gauge',
            'description' => 'Statistics of rows found by queries for all time since server start. Includes number of queries and min, max, avg, 95 and 99 percentile values',
            'name'        => 'found_rows_total'
        ]
    ];

    public function __construct(mysqli $mysqli)
    {
        $this->setConnection($mysqli);
        $this->getMetrics();
    }

    private function setConnection(mysqli $mysqli)
    {
        $this->connection = $mysqli;
    }

    private function getMetrics()
    {
        $data = $this->connection->query("SHOW STATUS");
        if ($data) {
            $data = $data->fetch_all(MYSQLI_ASSOC);
            foreach ($data as $row) {
                $this->addMetric($row['Counter'], $row['Value']);
            }
        }


        $threads = $this->connection->query("SHOW THREADS");

        $threadCount = 0;
        $maxTime     = 0;

        if ($threads) {
            $threads = $threads->fetch_all(MYSQLI_ASSOC);
            foreach ($threads as $row) {

                if (strtolower($row['Info']) === 'show threads') {
                    continue;
                }

                $threadCount++;
                if ((int)$row['Time'] > $maxTime) {
                    $maxTime = (int)$row['Time'];
                }
            }
        }


        $this->addMetric('thread_count', $threadCount);
        $this->addMetric('slowest_thread', $maxTime);


        $data = $this->connection->query("SHOW TABLES");
        if ($data) {
            $data = $data->fetch_all(MYSQLI_ASSOC);
            foreach ($data as $row) {

                $tableStatus = $this->connection->query('SHOW INDEX ' . $row['Index'] . ' STATUS');
                if ($tableStatus) {
                    $tableStatus = $tableStatus->fetch_all(MYSQLI_ASSOC);
                    foreach ($tableStatus as $tableStatusRow) {
                        $this->addMetric($tableStatusRow['Variable_name'], $tableStatusRow['Value'],
                            ['index' => $row['Index']]);
                    }
                }

            }
        }
    }


    public function drawMetrics()
    {
        foreach ($this->metrics as $metricName => $metrics) {
            echo "# HELP $metricName " . $metrics['info'] . "\n";
            echo "# TYPE $metricName " . $metrics['type'] . "\n";

            foreach ($metrics['data'] as $metric) {

                echo "manticore_$metricName " . ($this->getLabel($metric['label'] ?? null)) . "" . $this->formatValue($metric['value']) . "\n";
            }
        }

        if ($this->metrics !== []) {
            file_put_contents(HEALTH_FILE, '1');
        }

    }

    private function addMetric($name, $value, $label = null)
    {
        if (isset($this->metricNames[$name]['name'])) {

            if ($name === 'killed_rate') {
                $value = (float)$value;
            }

            if (strpos($name, 'query_time_') !== false || strpos($name, 'found_rows_') !== false) {

                $row = json_decode($value, true);

                foreach ($row as $k => $v) {
                    $metricData                                                 = ['value' => $v];
                    $metricData['label']                                        = $label + ['type' => $k];
                    $this->metrics[$this->metricNames[$name]['name']]['data'][] = $metricData;
                }
            } elseif (strpos($name, 'version') !== false) {

                $metricData                                                 = ['value' => 1];
                $metricData['label']                                        = ['version' => $value];
                $this->metrics[$this->metricNames[$name]['name']]['data'][] = $metricData;

            } else {

                $metricData = ['value' => $value];
                if (isset($label)) {
                    $metricData['label'] = $label;
                }
                $this->metrics[$this->metricNames[$name]['name']]['data'][] = $metricData;

            }

            $this->metrics[$this->metricNames[$name]['name']]['type'] = $this->metricNames[$name]['type'];
            $this->metrics[$this->metricNames[$name]['name']]['info'] = $this->metricNames[$name]['description'];
        }
    }

    private function getLabel($label)
    {
        $result = '';
        if ( ! empty($label)) {

            $labelCond = [];
            foreach ($label as $name => $value) {
                $labelCond[] = $name . '="' . $value . '"';
            }

            if ($labelCond !== []) {
                $result = '{' . implode(', ', $labelCond) . '} ';
            }
        }

        return $result;
    }

    private function formatValue($value)
    {
        if (in_array($value, ['OFF', '-'])) {
            $value = 0;
        }

        return $value;
    }
}
