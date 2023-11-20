INSERT INTO destinations (destination_number,from_airport,to_airport ,created_by, modified_by )
	SELECT concat(ap1.airport_number,'-',ap2.airport_number) ,
        ap1.airport_number,
        ap2.airport_number ,
        '1' as created_by,
        '1' as modified_by
    FROM airports ap1
    JOIN airports ap2
    WHERE ( ap1.airport_number NOT LIKE ap2.airport_number  ) AND (ap1.country_id = ap2.country_id  OR ( ap1.intl AND ap2.intl))
    ORDER BY ap1.airport_number,ap2.airport_number