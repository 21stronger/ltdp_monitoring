<?php
	function activityAlter($arrayActivities){
        $index = -1;
        $lastDate = "";
        $lastProjectID = "";
        $dataSummary = array();
        foreach ($arrayActivities as $key => $value) {
            if($lastProjectID!=$value['id_project']){
                $data['id_project']    = $value['id_project'];
                $data['date_monthly']   = 0;
                $data['plan']           = 0;
                $data['actual']         = 0;
                $data['monthly']        = 0;
                $data['status']         = "";
                $data['ytd']            = 0;
                $data['achievement']    = "";

                $lastProjectID  = $value['id_project'];
            }

            if($value['achievement']=='Open'||$value['achievement']=='Close'){
                $data['plan']           = $data['plan']+$value['plan_monthly_activity'];
                $data['actual']         = $data['actual']+$value['actual_monthly_activity'];
                $data['monthly']        = getMonthly($data['actual'], $data['plan']);
                $data['status']         = getStatus($data['monthly']);
                $data['ytd']            = $data['actual'];
                $data['achievement']    = getAch(
                                                    $value['achievement'], 
                                                    $data['actual'], 
                                                    $data['plan']
                                                );
            } else {
                $data['plan']           = 0;
                $data['actual']         = 0;
                $data['monthly']        = 0;
                $data['status']         = null;
                $data['ytd']            = 0;
                $data['achievement']    = $value['achievement'];
            }

            if($lastDate!=$value['date_monthly_activity']){
                $data['date_monthly']   = $value['date_monthly_activity'];
                $lastDate   = $value['date_monthly_activity'];

                array_push($dataSummary, $data);
                $index++;
            } else {
                $dataSummary[$index]['plan']    = $data['plan'];
                $dataSummary[$index]['actual']  = $data['actual'];
                $dataSummary[$index]['monthly'] = $data['monthly'];
                $dataSummary[$index]['status']  = $data['status'];
                $dataSummary[$index]['ytd']     = $data['ytd'];
                $dataSummary[$index]['achievement']  = $data['achievement'];
            }
        }
        return $dataSummary;
	}

	//helper
    function getMonthly($actual, $plan){
        if($actual==0&&$plan==0){
            $actual=1;
            $plan=1;
        }
        if($actual>0&&$plan==0){
            return 101;
        }

        return round(($actual/$plan)*100);
    }

    function getStatus($monthly){
        $result;
        switch(true) {
            case $monthly<100:
                $result = "Overdue";
                break;
            
            case $monthly==100:
                $result = "Ontime";
                break;
            
            case $monthly>100:
                $result = "Faster";
                break;
            
            default:
                $result = "Overdue";
                break;
        }

        return $result;
    }

    function getAch($source, $actual, $plan){
        switch ($source) {
            case 'Cancel':
                return 'Cancel';
                break;
            
            case 'Postpone':
                return 'Postpone';
                break;
            
            case $actual<100:
                return 'Open';
                break;

            case $actual>=100:
                return 'Close';
                break;

            default:
                return 'Open';
                break;
        }
    }
?>