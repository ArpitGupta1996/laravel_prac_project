<!DOCTYPE html>
<html>
<head>
    <title>Laravel Tut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
</head>
<body>

<div class="container mt-5">
      <h2 class="mb-3">Laravel jQuery Radio Button Div Hide Show Example</h2>
      <div class="mb-4">
        <div><input type="radio" name="type" value="userProfile" /> User Profile</div>
        <div><input type="radio" name="type" value="products" /> Products</div>
     </div>

      <div class="userProfile radioBtnChoose mb-3">
        <label>User Profile:</label>
        <input type="text" placeholder="Search user" />
      </div>
      <div class="products radioBtnChoose">
        <label>Products:</label>
        <input type="text" placeholder="Search product" />
      </div>
      <script>
        $(document).ready(function () {
          $('input[type="radio"]').click(function () {
            var inputValue = $(this).attr("value");
            var target = $("." + inputValue);
            $(".radioBtnChoose").not(target).hide();
            $(target).show();
          });
        });
      </script>

</div>

</body>
</html>
