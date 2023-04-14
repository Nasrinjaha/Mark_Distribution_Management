@extends('teacher.layout.full')
@section('content')
<h2 align="center">Mark Distribution</h2>
<form  align="center" action="{{ url('/assign-course') }}" method="post">
    @csrf
    
    <table>
        <thead>
            <tr>
                <th>Subject</th>
                <th>Option</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="dynamic">
            <tr>
                <td><input type="text" name="category[]"></td>
                <td><input type="number" name="marks[]"></td>
                <td><button type="button" class="btn btn-success" id="add_btn">add</button></td>
            </tr>
        </tbody>
    </table>
</form>
</body>
</html>
<script>
    $(document).ready(function(){
        $('#add_btn').on('click',function(){
            var html = '';
            html+='<tr>';
            html+='<td><input type="text" name="category[]"></td>';
            html+='<td><input type="number" name="marks[]"></td>';
            html+='<td><button type="button" class="btn btn-danger" id="rmv_btn">rmv</i></button></td>';
            html+='</tr>';
            $('#dynamic').append(html);

        });
        $(document).on('click','#rmv_btn',function(){
            $(this).closest('tr').remove();

        });
    });
</script>
@stop