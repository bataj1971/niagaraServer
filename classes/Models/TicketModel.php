<?php

namespace Models;

use DataModel\DbModel;

class TicketModel extends DbModel
{
    public function __construct()
    {
        parent::__construct('Ticket');

    }

    /**
     * getQueryFieldList
     *
     * @return void
     */
    protected function getQueryFieldList(): array
    {
        $fieldList = parent::getQueryFieldList();

        $fieldList['passenger_name'] = "passenger.name";
        $fieldList['flight_number'] = "flight.flight_number";
        $fieldList['flight_departure_time'] = "flight.flight_departure_time";

        $fieldList['departure'] = "
            JSON_OBJECT(
				'airport',airport_from.name,
				'location',airport_from.location
				)            
        ";
        $fieldList['destination'] = "
            JSON_OBJECT(
				'airport',airport_to.name,
				'location',airport_to.location
				)            
        ";

        $fieldList['aircraft'] = "
            JSON_OBJECT(
				'registration_number',aircraft.registration_number,
				'type',aircraft_type.aircraft_type_id
				)            
        ";        

    
	// f.flight_number, d.destination_number, f.flight_departure_time, 
    
    // ap1.name as departure_airport, ap1.location as airport_departure_location, ap2.name as arrival_airport, ap2.location as airport_arrival_location,
    // ac.registration_number as aircrafr_reg_number  , act.aircraft_type_id
	
        

        return $fieldList;
    }

    /**
     * getQueryJoin
     *
     * @return array
     */
    protected function getQueryJoin(): array
    {
        $joinList = parent::getQueryJoin();
        $joinList['flight'] = "JOIN flights as flight ON flight.flight_number = tickets.flight_number";
        
        $joinList['destination'] = "JOIN destinations as destination ON destination.destination_number = flight.destination_number";
        
        $joinList['airport_from'] = "JOIN airports as airport_from  ON destination.from_airport = airport_from.airport_number";
        $joinList['airport_to'] = "JOIN airports as airport_to  ON destination.to_airport = airport_to.airport_number";


        $joinList['aircraft'] = "JOIN aircrafts as aircraft  ON aircraft.id = flight.aircraft_id";
        $joinList['aircraft_type'] = "JOIN aircraft_types as aircraft_type ON  aircraft.aircraft_type_id = aircraft_type.aircraft_type_id";

        $joinList['pilot'] = "JOIN pilots as pilot  ON flight.pilot_id = pilot.id";
        $joinList['passenger'] = "JOIN passengers as passenger  ON tickets.passenger_id = passenger.id";
        
        return $joinList;
    }

}
