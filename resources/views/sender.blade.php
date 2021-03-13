<form action="/send" method="POST">
    {{ csrf_field() }}
    <input type="text" name="message">
    <button type="submit">SEND</button>
</form>