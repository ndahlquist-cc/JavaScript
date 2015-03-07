<?php
	
	// pass information from javascript to php variables
	$firstName = $_POST["firstName"];
	$lastName = $_POST["lastName"];
	$streetName = $_POST["streetName"];
	$cityName = $_POST["cityName"];
	$provinceName = $_POST["provinceName"];
	$postalCodeName = $_POST["postalCodeName"];
	$orderTextAreaName = $_POST["orderTextAreaName"];
	$phpOrderTotal = $_POST["phpOrderTotal"];
	
	// put php variables into Array
	$varArray = array($firstName, $lastName, $streetName, $cityName, $provinceName, $postalCodeName, $orderTextAreaName, $phpOrderTotal); 
	
	// call tax function to load array with provincial taxes
	$taxArray = taxesArray();
	
	// declare variables used for calculations
	$deliveryTime=0;
	$taxes=0;
	$totalPlusTax = 0;
	
	// validate information sent to php
	$isGood = validations($varArray);
	
	// if no errors on validation, determine shipping cost and delivery time 
	// based on cost of order
	if ($isGood == true)
	{
		if ($varArray[7] > 0 && $varArray[7] <= 25.00)
		{
			$shippingCost = 3.00;
			$deliveryTime = 1;
		}
		elseif ($varArray[7] >= 25.01 && $varArray[7] <= 50.00)
		{
			$shippingCost = 4.00;
			$deliveryTime = 1;
		}
		elseif ($varArray[7] >= 50.01 && $varArray[7] <= 75.00)
		{
			$shippingCost = 5.00;
			$deliveryTime = 3;
		}
		elseif ($varArray[7] > 75.00)
		{
			$shippingCost = 6.00;
			$deliveryTime = 4;
		}
		
		// tax rates are based on province
		// determine the amount of tax to add to total
		// and the total plus taxes.
		if ($varArray[4] == "Alberta")
		{
			$taxes = $varArray[7] * $taxArray[2];
			$totalPlusTax = $varArray[7] + $taxes + $shippingCost;
		}
		if ($varArray[4] == "British Columbia")
		{
			$taxes = $varArray[7] * ($taxArray[0] + $taxArray[1]);
			$totalPlusTax = $varArray[7] + $taxes + $shippingCost;
		}
		if ($varArray[4] == "Manitoba")
		{
			$taxes = $varArray[7] * ($taxArray[5] + $taxArray[6]);
			$totalPlusTax = $varArray[7] + $taxes + $shippingCost;
		}
		if ($varArray[4] == "New Brunswick")
		{
			$taxes = $varArray[7] * $taxArray[12];
			$totalPlusTax = $varArray[7] + $taxes + $shippingCost;
		}
		if ($varArray[4] == "Newfoundland")
		{
			$taxes = $varArray[7] * $taxArray[10];
			$totalPlusTax = $varArray[7] + $taxes + $shippingCost;
		}
		if ($varArray[4] == "Northwest Territories")
		{
			$taxes = $varArray[7] * $taxArray[14];
			$totalPlusTax = $varArray[7] + $taxes + $shippingCost;
		}
		if ($varArray[4] == "Nova Scotia")
		{
			$taxes = $varArray[7] *  $taxArray[11];
			$totalPlusTax = $varArray[7] + $taxes + $shippingCost;
		}
		if ($varArray[4] == "Nunavut")
		{
			$taxes = $varArray[7] * $taxArray[15];
			$totalPlusTax = $varArray[7] + $taxes + $shippingCost;
		}
		if ($varArray[4] == "Ontario")
		{
			$taxes = $varArray[7] * $taxArray[7];
			$totalPlusTax = $varArray[7] + $taxes + $shippingCost;
		}
		if ($varArray[4] == "Prince Edward Island")
		{
			$taxes = $varArray[7] * $taxArray[13];
			$totalPlusTax = $varArray[7] + $taxes + $shippingCost;
		}
		if ($varArray[4] == "Quebec")
		{
			$taxes = $varArray[7] * ($taxArray[8] + $taxArray[9]);
			$totalPlusTax = $varArray[7] + $taxes + $shippingCost;
		}
		if ($varArray[4] == "Saskatchewan")
		{
			$taxes = $varArray[7] * ($taxArray[3] + $taxArray[4]);
			$totalPlusTax = $varArray[7] + $taxes + $shippingCost;
		}
		if ($varArray[4] == "Yukon")
		{
			$taxes = $varArray[7] * $taxArray[16];
			$totalPlusTax = $varArray[7] + $taxes + $shippingCost;
		}
		// Print customer information to screen
		print("<b>Shipping To: </b><br />" . "$varArray[1] $varArray[0]<br />");
		print($varArray[2] . "<br />");
		print($varArray[3] . ", " . $varArray[4] . "<br />");
		print($varArray[5] . "<br />");
		print("<br />");
		
		// Print order information to screen
		print("<b>Order Information:</b><br />");
		print("Your Order is Processed, Please verify the information<br />");
		print($varArray[6] . "<br />");
		print("Tax = $" . $taxes . "<br />");
		print("Delivery = $" . $shippingCost . "<br />");
		print("<b>Total Cost: $</b>" . $totalPlusTax . "<br />");
		print("<br />");
		
		// create variables to use in the date function
		$day=date("j" + $deliveryTime);
		$month=date("n");
		$year=date("Y");
		$fullMonth=date("F");
		$one = 1;
		$thirtyOne = 31;
		$twelve = 12;
		$twentyEight = 28;
		$twentyNine = 29;
		$thirty = 30;
		
		// if the year is a leap year, February has 29 days
		if ($year%4 == 0)
		{
			// if the month has 31 days
			if ($fullMonth == "January" OR $fullMonth == "March" 
			OR $fullMonth == "May" OR $fullMonth == "July" OR $fullMonth == "August" 
			OR $fullMonth == "October" OR $fullMonth == "December")
			{
				if ($day > 31)
				{
					$day = (int)$day - (int)$thiryOne;
					$month = (int)$month + (int)$one;
					if ($month > 12)
					{
						$month = (int)$month - (int)$twelve;
						$year = (int)$year + (int)$one;
					}
				}
			}
			// if the month has 30 days
			elseif ($fullMonth == "April" OR $fullMonth == "June" 
			OR $fullMonth == "September" OR $fullMonth == "November")
			{
				if ($day > 30)
				{
					$day = (int)$day - (int)$thirty;
					$month = (int)$month + (int)$one;
				}
			}
			// if the month has 29 days
			elseif ($fullMonth == "February")
			{
				if ($day > 29)
				{
					$day = (int)$day - (int)$twentyNine;
					$month = (int)$month + (int)$one;
				}
			}
		}
		
		// if the year is not a leap year, February has 28 days
		elseif ($year%4 != 0)
		{
			// if the month has 31 days
			if ($fullMonth == "January" OR $fullMonth == "March" 
			OR $fullMonth == "May" OR $fullMonth == "July" OR $fullMonth == "August" 
			OR $fullMonth == "October" OR $fullMonth == "December")
			{
				if ($day > 31)
				{
					$day = (int)$day - (int)$thirtyOne;
					$month = (int)$month + (int)$one;
					if ($month > 12)
					{
						$month = (int)$month - (int)$twelve;
						$year = (int)$year + (int)$one;
					}
				}
			}
			// if the month has 30 days
			elseif ($fullMonth == "April" OR $fullMonth == "June" 
			OR $fullMonth == "September" OR $fullMonth == "November")
			{
				if ($day > 30)
				{
					$day = (int)$day - (int)$thirty;
					$month = (int)$month + (int)$one;
				}
			}
			// if the month has 28 days
			elseif ($fullMonth == "February")
			{
				if ($day  > 28)
				{
					$day = (int)$day - (int)$twentyEight;
					$month = (int)$month + (int)$one;
				}
			}
		}
		// Print the delivery date
		print("Estimated Delivery Date is: " . date("$day.$month.$year")); 
	}

	// this function places each provinces tax rate into an array
	// and returns the array when called
	function taxesArray()
	{
		$bcGst = 0.05;
		$bcPst = 0.07;
		$abGst = 0.05;
		$skGst = 0.05;
		$skPst = 0.05;
		$mbGst = 0.05;
		$mbPst = 0.08;
		$onHst = 0.13;
		$qcGst = 0.05;
		$qcPst = 0.09975;
		$nlHst = 0.13;
		$nsHst = 0.15;
		$nbHst = 0.13;
		$peHst = 0.14;
		$ntGst = 0.05;
		$nuGst = 0.05;
		$ytGst = 0.05;
		$taxArray = array($bcGst, $bcPst, $abGst, $skGst, $skPst, $mbGst, $mbPst, $onHst, $qcGst, $qcPst, $nlHst, $nsHst, $nbHst, $peHst, $ntGst, $nuGst, $ytGst);
		return $taxArray;
	}
			
	// this function validates the information sent
	// from the javascript.  It returns either
	// true if the information is present
	// or false if the information is missing
	function validations($varArray)
	{			
		$errorMessage = ""; // variable to hold the error message
		$isGood = true;

		if ($varArray[0] == "")
		{	
			$errorMessage += "First Name is null.<br />";
		}
		if ($varArray[1] == "")
		{
			$errorMessage += "Last Name is null.<br />";
		}
		if ($varArray[2] == "")
		{
			$errorMessage += "Street Address is null.<br />";
		}
		if ($varArray[3] == "")
		{
			$errorMessage += "City name is null.<br />";
		}
		if (strlen($varArray[3]) < 3)
		{
			$errorMessage += "City name must be at least three letters long.<br />";
		}
		if ($varArray[4] == "selectProvince")
		{
			$errorMessage += "Province is null.<br />";
		}
		if (strlen($varArray[4]) <> 7)
		{
			$errorMessage += "Postal Code must be seven characters in length.<br />";
		}
		if ($varArray[5] == "")
		{
			$errorMessage += "Postal Code is null.<br />";
		}
		if ($varArray[6] == "")
		{
			$errorMessage += "Order is null.<br />";
		}
		
		if ($errorMessage != "")
		{
			print($errorMessage); // if there is an error message, display alert
			$isGood = false;
		}
		return $isGood;
	}
?>