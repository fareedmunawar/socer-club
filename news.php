<?php include('header.php'); ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link rel="stylesheet" href="/assets/css/news.css">

<main class="responsive-wrapper">
    <div class="page-title">
        <h1>Latest Match Updates</h1>
    </div>
    <div class="magazine-layout">
        <div class="magazine-column">
            @if(isset($apiResponse) && isset($apiResponse['teams']) && isset($apiResponse['teams']['Match']))
                @foreach ($apiResponse['teams']['Match'] as $match)
                    <article class="article">
                        <h2 class="article-title article-title--large">
                            {{ $match['HomeTeam'] }} vs {{ $match['AwayTeam'] }}
                        </h2>
                        <div class="article-excerpt">
                            <p><strong>League:</strong> {{ $match['League'] }}</p>
                            <p><strong>Date:</strong> {{ $match['Date'] }}</p>
                            <p><strong>Time:</strong> {{ $match['Time'] }}</p>
                            <p><strong>Home Goals:</strong> {{ $match['HomeGoals'] }}</p>
                            <p><strong>Away Goals:</strong> {{ $match['AwayGoals'] }}</p>
                            <p><strong>Home Goal Details:</strong> {{ $match['HomeGoalDetails'] }}</p>
                            <p><strong>Away Goal Details:</strong> {{ $match['AwayGoalDetails'] }}</p>
                        </div>
                    </article>
                @endforeach
            @else
                <p>No match data available.</p>
            @endif
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        var apiUrl = "https://www.thesportsdb.com/api/v1/json/{APIKEY}/searchplayers.php?t={TeamName}&p={Playername}";

        // Make API call to get the match details
        $.get(apiUrl, function(data) {
            if (data) {
                // Store the API response in a variable
                var apiResponse = data;

                // Your code to process and display the match details here
                $(".article").each(function(index) {
                    var $this = $(this);
                    var match = apiResponse['teams']['Match'][index];
                    $this.find(".api-content").html("<strong>Home Team:</strong> " + match['HomeTeam'] + "<br><strong>Away Team:</strong> " + match['AwayTeam'] + "<br><strong>League:</strong> " + match['League'] + "<br><strong>Date:</strong> " + match['Date'] + "<br><strong>Time:</strong> " + match['Time'] + "<br><strong>Home Goals:</strong> " + match['HomeGoals'] + "<br><strong>Away Goals:</strong> " + match['AwayGoals']);
                });
            } else {
                alert("Data not found");
            }
        });
    });
</script>

<?php include ('footer.php'); ?>

