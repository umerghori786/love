<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

<div class="container mt-3">
  
  <form action="{{route('posts.store')}}" method="post">
    @csrf
    <div class="form-floating mb-3 mt-3">
      <input type="datetime-local" class="form-control" id="email" placeholder="due date" name="due_date">
      <label for="email">Due Date</label>
    </div>
    <div class="form-floating mt-3 mb-3">
      <input type="datetime-local" class="form-control" id="pwd" placeholder="remiander date" name="remiander_date">
      <label for="pwd">Remainder Date</label>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
</div>

</body>
</html>
