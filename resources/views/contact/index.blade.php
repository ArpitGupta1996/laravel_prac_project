<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Laravel View</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>

<body>

    <!DOCTYPE html>
    <html>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
            }

            * {
                box-sizing: border-box;
            }

            input[type=text],
            select,
            textarea {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                margin-top: 6px;
                margin-bottom: 16px;
                resize: vertical;
            }

            input[type=email],
            select,
            textarea {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                margin-top: 6px;
                margin-bottom: 16px;
                resize: vertical;
            }


            input[type=number],
            select,
            textarea {
                width: 100%;
                padding: 12px;
                border: 1px solid #ccc;
                border-radius: 4px;
                box-sizing: border-box;
                margin-top: 6px;
                margin-bottom: 16px;
                resize: vertical;
            }

            input[type=submit] {
                background-color: #04AA6D;
                color: white;
                padding: 12px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
            }

            input[type=submit]:hover {
                background-color: #45a049;
            }

            .container {
                border-radius: 5px;
                background-color: #f2f2f2;
                padding: 20px;
            }
        </style>
    </head>

    <body>

        <h3>Contact Form</h3>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
        <div class="container">
            <form action="{{ route('contact.store') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <label for="fname">Name</label>
                <input type="text" id="fname" name="name" placeholder="Your name..">

                <label for="email">Email</label>
                <input type="email" id="lname" name="email" placeholder="Your email.." class="form-control">

                <label for="phone">Phone</label>
                <input type="number" id="phone" name="phone" placeholder="Your phone no.." class="form-control"
                    min="10">

                <label for="country">Country</label>
                <select id="country" name="country">
                    <option value="australia">Australia</option>
                    <option value="canada">Canada</option>
                    <option value="usa">USA</option>
                </select>

                <label for="subject">Subject</label>
                <textarea id="subject" name="subject" placeholder="Write something.." style="height:200px"></textarea>

                <input type="submit" value="Submit">

                {{-- <button class="g-recaptcha mt-4" data-sitekey="{{ config('services.recaptcha.key') }}">Submit</button> --}}

                <div class="g-recaptcha" data-sitekey="{{ config('services.recaptcha.key') }}"></div>
            </form>


            <script type="text/javascript">
                var onloadCallback = function() {
                    grecaptcha.render('html_element', {
                        'sitekey': 'your_site_key'
                    });
                };
            </script>

            <!-- Your other HTML content goes here -->

            <iframe class="map" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                src="https://maps.google.com/maps?width=100%25&amp;height=100&amp;hl=en&amp;q=+(WorldTradePark)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"
                width="100%" height="300">
                <a href="http://www.gps.ie/">truck gps</a>
            </iframe>

            <!-- Your other HTML content goes here -->
        </div>






    </body>

    </html>
