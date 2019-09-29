$(document).ready(function(){
	$.ajax({
		url: "http://localhost/perpusjajal/chartjs/data.php",
		method: "GET",
		success: function(data) {
			console.log(data);
			var idBuku = [];
			var tahun = [];

			for(var i in data) {
				
				idBuku.push("ID ke-" + data[i].id);
				tahun.push(data[i].tahun_terbit);
			}

			var chartdata = {
				labels: idBuku,
				datasets : [
					{
						label: 'ID',
						backgroundColor: 'rgba(200, 200, 200, 0.75)',
						borderColor: 'rgba(200, 200, 200, 0.75)',
						hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
						hoverBorderColor: 'rgba(200, 200, 200, 1)',
						data: tahun
					}
				]
			};

			var ctx = $("#mycanvas");

			var barGraph = new Chart(ctx, {
				type: 'bar',
				data: chartdata
			});
		},
		error: function(data) {
			console.log(data);
		}
	});
});