<?php
namespace App\CustomClasses;


class TrackerGG_Helper {
    public $gameName;
    public $userID;
    public  $headers = [
        "TRN-Api-Key: 9bb88e4e-b954-4775-a6ad-f32769904da2"
    ];
    public function __construct($gameName, $userID)
    {
        $this->gameName = $gameName;
        $this->userID = $userID;
    }
    public function GetTrackerInfo() {
        if (isset($this->gameName))
        {
                if ($this->gameName=="Apex Legends")
                {


                    $url = 
                    "https://public-api.tracker.gg/v2/apex/standard/profile/psn/".$this->userID;
                    $APIHELPER = new Api_Helper($url, $this->headers, true, true);
                    $response = $APIHELPER->CallApi();
                    return $response;
                }
                else if ($this->gameName=="CSGO")
                {
                    $url = 
                    "https://public-api.tracker.gg/v2/csgo/standard/profile/steam/".$this->userID;
                    $APIHELPER = new Api_Helper($url, $this->headers, true, true);
                    $response = $APIHELPER->CallApi();
                    return $response;
                }
        }
        
    }
}