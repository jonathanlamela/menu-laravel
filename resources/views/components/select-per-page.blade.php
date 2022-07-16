<form method="get">
    <label>Elementi per pagina</label>
    <select name="elementsPerPage" class="form-control" onchange="this.form.submit()">
        <option value="5" @if($elementsPerPage=="5" ) selected @endif>5</option>
        <option value="10" @if($elementsPerPage=="10" ) selected @endif>10</option>
        <option value="50" @if($elementsPerPage=="50" ) selected @endif>50</option>
    </select>
</form>
