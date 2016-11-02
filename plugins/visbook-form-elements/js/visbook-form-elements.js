
(function($) {

	function addBookingContent(){
		var content = '<label for="dateFrom">Ankomstdato</label><input id="dateFrom" name="from" type="text"  /><label for="dateTo">Avreisedato</label><input id="dateTo" name="to" type="text" /><a id="booking-submit" href="#" class="uk-button uk-button-primary">🐑</a>';
		$("#booking-container, #booking-container-sidepanel").html(content);
		$("#booking-container, #booking-container-sidepanel").addClass("uk-form");
	}

	function updateBookingUrl(parameters){
		var urlParameters = "";
		$(parameters).each(function (){
			var dateString = this.value;
			dateStringArray = dateString.split("/");
			this.month = dateStringArray[0];
			this.day = dateStringArray[1];
			this.year = dateStringArray[2];
			urlParameters 	+= this.name + "Year=" + this.year + "&" 
			+ this.name + "Month=" + this.month + "&"
			+ this.name + "Day=" + this.day + "&";
		});

		var bookingUrl = "http://booking.visbook.com/554?" + urlParameters + "source=external";
		$("#booking-submit").attr("href", bookingUrl);
	}
	$(document).ready(function (){
		addBookingContent();

		var dateFrom = "";

		$("#booking-container input").change(function () {
			var parameters = [];
			$("#booking-container input").each(function (){
				var name = $(this).attr("name");
				var value = $(this).val();
				var parameter = {};
				parameter.name = name;
				parameter.value = value;
				parameters.push(parameter);
				updateBookingUrl(parameters);
			});

			$( "#booking-container input" ).datepicker();
		});

		
		var dateFormat = "dd.mm.yy",
		from = $( "#dateFrom" )
		.datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			showWeek: true,
			numberOfMonths: 1
		})
		.on( "change", function() {
			to.datepicker( "option", "minDate", getDate( this ) );
		}),
		to = $( "#dateTo" ).datepicker({
			defaultDate: "+1w",
			changeMonth: true,
			showWeek: true,
			numberOfMonths: 1
		})
		.on( "change", function() {
			from.datepicker( "option", "maxDate", getDate( this ) );
		});

		function getDate( element ) {
			var date;
			try {
				date = $.datepicker.parseDate( dateFormat, element.value );
			} catch( error ) {
				date = null;
			}

			return date;
		}
	});

	}(jQuery));