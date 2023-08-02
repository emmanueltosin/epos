

function drawChat(all){
	var ctx = document.getElementById("basiclinechart");
let myChart = new Chart(ctx, {
    type: 'line',
   data: {
			labels: all.labels,
			datasets:all.datasets
		}
});
}

drawChat(all);