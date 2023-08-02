if(document.getElementById('calendar')){
	 $('#calendar').fullCalendar({
		 'month': 12,
		 header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month'
        },
		header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay'
        },
        buttonText: {
            prev: "",
            next: "",
            today: 'today',
            month: 'M',
            week: 'W',
            day: 'D'
        }
	 });
}