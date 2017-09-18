<table class="table">
	<tr>
		<td>Người viết:</td>
		<td>{{ $data->createdBy->name }}</td>
	</tr>
	<tr>
		<td>Người chỉnh sửa:</td>
		<td>{{ $data->updatedBy->name }}</td>
	</tr>
	<tr>
		<td>Tóm tắt:</td>
		<td>{{ $data->description }}</td>
	</tr>
</table>;