<?php

class SitePerformanceModel
{
    use Model;

    public function getTotalVisits24h()
    {
        $query = "SELECT COUNT(*) as total FROM user_traffic WHERE visited_at >= NOW() - INTERVAL 1 DAY";
        return $this->query($query)[0]['total'] ?? 0;
    }

    public function getUniqueVisitors24h()
    {
        $query = "SELECT COUNT(DISTINCT ip_address) as unique_visitors FROM user_traffic WHERE visited_at >= NOW() - INTERVAL 1 DAY";
        return $this->query($query)[0]['unique_visitors'] ?? 0;
    }

    public function getAverageSessionTime24h()
    {
        $query = "
            SELECT AVG(session_duration) as avg_time
            FROM (
                SELECT TIMESTAMPDIFF(SECOND, MIN(visited_at), MAX(visited_at)) AS session_duration
                FROM user_traffic
                WHERE visited_at >= NOW() - INTERVAL 1 DAY
                GROUP BY session_id
            ) as sessions
        ";
        $result = $this->query($query)[0]['avg_time'] ?? null;
        if ($result) {
            $minutes = floor($result / 60);
            $seconds = $result % 60;
            return "{$minutes}m {$seconds}s";
        }
        return "0m 0s";
    }

    public function getVisitsLast7Days()
    {
        $query = "
            SELECT DATE(visited_at) as day, COUNT(*) as visits
            FROM user_traffic
            WHERE visited_at >= CURDATE() - INTERVAL 6 DAY
            GROUP BY day
            ORDER BY day ASC
        ";
        return $this->query($query);
    }

    public function logSiteTraffic($user_id = null, $ip, $session_id = null, $user_agent = null)
    {

        $query = "INSERT INTO user_traffic (user_id, ip_address, session_id, user_agent) VALUES (:user_id, :ip, :session_id, :user_agent)";
        $this->query($query, [
            'user_id' => $user_id,
            'ip' => $ip,
            'session_id' => $session_id,
            'user_agent' => $user_agent
        ]);

    }
}