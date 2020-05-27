<?php
include "header.php";
include "config.php";
?>
<div class="container">
    <div class="row">
        <div class="name"><h1><?php echo $json->name;?> weather</h1>
            <div class="time">
                <div><?php echo date("l g:i a", $currentTime); ?></div>
                <div><?php echo date("j F, Y", $currentTime); ?></div>
                <div><?php echo ucwords($json->weather[0]->description); ?></div>
                <img src="http://openweathermap.org/img/wn/<?php echo $json->weather[0]->icon;?>@2x.png">
            </div>
            <div class="weather">
                <div>Temp <?php echo $json->main->temp;?> °С</div>
                <div>Feels like<?php echo $json->main->feels_like;?> °С</div>
                <div>Wind:<?php echo $json->wind->speed;?> km/h</div>
                <div>Humidity:<?php echo $json->main->humidity;?> %</div>
            </div>
        </div>
    </div>
</div>
<?php    
if (isset($_POST['submit'])) {
    try {
        $connection = new PDO($dsn, $user, $psw, $options);

        $new_marker = array(
            "name" => $_POST['name'],
            "lat" => $_POST['lat'],
            "lng" => $_POST['lng'],
            "description" => $_POST['description'],
            "added" => $_POST['added']
        );
        $sql = sprintf(
            "INSERT INTO %s (%s) values (%s)",
            "markers.markers",
            implode(", ", array_keys($new_marker)),
            ":" . implode(", :", array_keys($new_marker))
        );
        $stmt = $connection->prepare($sql);
        $stmt->execute($new_marker);
    } catch (PDOException $error) {
        echo $sql . "<br>" . $error->getMessage();
    }
}
?>
<div class="container ">
    <div class="row">
        <div class="card-header">
            <h2>Loo marker</h2>
        </div>
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <form method="post">
                <div class="form-group">
                    <input type="text" name="id" class="form-control" placeholder="13" value="auto" id="id">
                </div>
                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Koha nimi">
                </div>
                <div class="form-group">
                    <input type="text" name="lat" id="lat" class="form-control" placeholder="Laiuskraad">
                </div>
                <div class="form-group">
                    <input type="text" name="lng" id="lng" class="form-control" placeholder="Pikkuskraad">
                </div>
                <div class="form-group">
                    <input type="text" name="description" id="description" class="form-control" placeholder="Kirjeldus">
                </div>
                <div class="form-group">
                    <input type="datetime-local" name="added" value="<?= date('Y-m-d\TH:i') ?>" id="added">
                </div>
                <div class="form-group">
                    <button type="submit" name="submit" class="btn btn-info">Sisesta koht</button>
                </div>
            </form>
            <?php
            if (isset($_POST['submit']) && $stmt) {
                echo escape($_POST['name']); ?> <div class="">Edukalt lisatud</div>
            <?php } ?>

        </div>
        <div class="col-md-2"></div>

    </div>
</div>
<div id="map">
    <script>
        var map;

        function initMap() {
            var start = {
                lat: 58.247537,
                lng: 22.479283
            };

            map = new google.maps.Map(document.getElementById('map'), {
                center: start,
                zoom: 8
            });

            map.addListener('click', function(event) {
                var lat = event.latLng.lat();
                var lng = event.latLng.lng();
                var newPlace = {
                    lat: lat,
                    lng: lng
                };
                addMarker(newPlace, null);

                document.getElementById("lat").value = lat;
                document.getElementById("lng").value = lng;
            });

            fetch('json.php')
                .then((response) => {
                    return response.json();
                })
                .then((data) => {
                    for (k in data) {
                        console.log(data[k]);
                        var place = data[k];
                        var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';

                        addMarker(place, image);
                    }
                });
        }

        function addMarker(place, image) {
            new google.maps.Marker({
                position: place,
                map: map,
                icon: image
            });
        }
    </script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?callback=initMap">
    </script>
</div>

<<script src="https://maps.googleapis.com/maps/api/js?callback=initMap" async defer>
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <!-- Code injected by live-server -->
    <script type="text/javascript">
        // <![CDATA[  <-- For SVG support
        if ('WebSocket' in window) {
            (function() {
                function refreshCSS() {
                    var sheets = [].slice.call(document.getElementsByTagName("link"));
                    var head = document.getElementsByTagName("head")[0];
                    for (var i = 0; i < sheets.length; ++i) {
                        var elem = sheets[i];
                        var parent = elem.parentElement || head;
                        parent.removeChild(elem);
                        var rel = elem.rel;
                        if (elem.href && typeof rel != "string" || rel.length == 0 || rel.toLowerCase() == "stylesheet") {
                            var url = elem.href.replace(/(&|\?)_cacheOverride=\d+/, '');
                            elem.href = url + (url.indexOf('?') >= 0 ? '&' : '?') + '_cacheOverride=' + (new Date().valueOf());
                        }
                        parent.appendChild(elem);
                    }
                }
                var protocol = window.location.protocol === 'http:' ? 'ws://' : 'wss://';
                var address = protocol + window.location.host + window.location.pathname + '/ws';
                var socket = new WebSocket(address);
                socket.onmessage = function(msg) {
                    if (msg.data == 'reload') window.location.reload();
                    else if (msg.data == 'refreshcss') refreshCSS();
                };
                if (sessionStorage && !sessionStorage.getItem('IsThisFirstTime_Log_From_LiveServer')) {
                    console.log('Live reload enabled.');
                    sessionStorage.setItem('IsThisFirstTime_Log_From_LiveServer', true);
                }
            })();
        } else {
            console.error('Upgrade your browser. This Browser is NOT supported WebSocket for Live-Reloading.');
        }
        // ]]>
    </script>

    <?php include "footer.php"; ?>