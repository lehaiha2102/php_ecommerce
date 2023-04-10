<!DOCTYPE html>
<html>
<head>
	<title>Filter Table</title>
	<style>
		table {
			border-collapse: collapse;
			width: 100%;
		}

		th, td {
			text-align: left;
			padding: 8px;
			border-bottom: 1px solid #ddd;
		}

		tr:hover {
			background-color: #f5f5f5;
		}
	</style>
</head>
<body>
	<h2>Filter Table Example</h2>

	<input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search for names...">

	<table id="myTable">
		<thead>
			<tr>
				<th>Name</th>
				<th>Age</th>
				<th>City</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td>John Doe</td>
				<td>25</td>
				<td>New York</td>
			</tr>
			<tr>
				<td>Jane Smith</td>
				<td>30</td>
				<td>Los Angeles</td>
			</tr>
			<tr>
				<td>Mike Johnson</td>
				<td>35</td>
				<td>Chicago</td>
			</tr>
			<tr>
				<td>Emily Davis</td>
				<td>28</td>
				<td>Houston</td>
			</tr>
			<tr>
				<td>Tom Brown</td>
				<td>42</td>
				<td>Miami</td>
			</tr>
		</tbody>
	</table>

	<script>
		function filterTable() {
			// Lấy giá trị input và chuyển thành chữ thường
			var input = document.getElementById("searchInput");
			var filter = input.value.toLowerCase();

			// Lấy bảng và các hàng
			var table = document.getElementById("myTable");
			var rows = table.getElementsByTagName("tr");

			// Lặp qua các hàng và ẩn/hiện hàng tương ứng
			for (var i = 0; i < rows.length; i++) {
				var nameCol = rows[i].getElementsByTagName("td")[0];
				var ageCol = rows[i].getElementsByTagName("td")[1];
				var cityCol = rows[i].getElementsByTagName("td")[2];

				if (nameCol && nameCol.innerHTML.toLowerCase().indexOf(filter) > -1) {
					rows[i].style.display = "";
				} else if (ageCol && ageCol.innerHTML.toLowerCase().indexOf(filter) > -1) {
					rows[i].style.display = "";
				} else if (cityCol && cityCol.innerHTML.toLowerCase().indexOf(filter) > -1) {
					rows[i].style.display = "";
				} else {
					rows[i].style.display = "none";
				}
			}
		}
	</script>
</body>
</html>
