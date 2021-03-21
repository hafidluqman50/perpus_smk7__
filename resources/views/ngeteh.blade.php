<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Oke</title>
</head>
<body>
	<form action="{{ url('/ngeteh') }}" method="POST">
		@csrf
		<input type="text" name="mantap">
		<button>Oke</button>
	</form>
</body>
</html>

<script src="https://unpkg.com/dayjs@1.8.21/dayjs.min.js"></script>
<script src="https://unpkg.com/dayjs@1.8.21/plugin/relativeTime.js"></script>
<script>
	dayjs.extend(window.dayjs_plugin_relativeTime)

	console.log(dayjs().from(dayjs('1990')))

	dayjs().toNow()
</script>