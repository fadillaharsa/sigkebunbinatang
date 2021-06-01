if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(position => {
        localCoord = position.coords;
        objLocalCoord = {
            lat: -6.8905,
            lng: 107.60672
        }

        objUserCoord = {
            lat: localCoord.latitude,
            lng: localCoord.longitude
        }

        let platform = new H.service.Platform({
            'apikey': window.hereApiKey
        });

        // Obtain the default map types from the platform object
        let defaultLayers = platform.createDefaultLayers();

        // Instantiate (and display) a map object:
        let map = new H.Map(
                document.getElementById('mapContainer'),
                defaultLayers.vector.normal.map,
                {
                    zoom: 16.2,
                    center: objLocalCoord,
                    pixelRatio: window.devicePixelRatio || 1
                });
            window.addEventListener('resize', () => map.getViewPort().resize());

                         
        let ui = H.ui.UI.createDefault(map, defaultLayers);
        let zoom = ui.getControl('zoom');

        zoom.setAlignment('top-left');
        restrictMap(map);
        // Create an info bubble object at a specific geographic location:
        let bubble = new H.ui.InfoBubble({ lng: -6.99688, lat: 107.56771 }, {
            content: '<b>Hello World!</b>'
        });
        // Add info bubble to the UI:
        ui.addBubble(bubble);
        let mapEvents = new H.mapevents.MapEvents(map);
        let behavior = new H.mapevents.Behavior(mapEvents);

        // Draggable Marker Function
        function addDragableMarker(map, behavior) {
            let inputLat = document.getElementById('lat');
            let inputLng = document.getElementById('lng');

            if (inputLat.value != '' && inputLng.value != '') {
                objLocalCoord = {
                    lat: inputLat.value,
                    lng: inputLng.value
                }
            }

            let marker = new H.map.Marker(objLocalCoord, {
                volatility: true
            })

            marker.draggable = true;
            map.addObject(marker);

            // disable the default draggability of the underlying map
            // and calculate the offset between mouse and target's position
            // when starting to drag a marker object:
            map.addEventListener('dragstart', function(ev) {
                let target = ev.target,
                    pointer = ev.currentPointer;
                if (target instanceof H.map.Marker) {
                    let targetPosition = map.geoToScreen(target.getGeometry());
                    target['offset'] = new H.math.Point(
                        pointer.viewportX - targetPosition.x, pointer.viewportY - targetPosition.y
                    );
                    behavior.disable();
                }
            }, false);

            // Listen to the drag event and move the position of the marker
            // as necessary
            map.addEventListener('drag', function(ev) {
                let target = ev.target,
                    pointer = ev.currentPointer;
                if (target instanceof H.map.Marker) {
                    target.setGeometry(
                        map.screenToGeo(
                            pointer.viewportX - target['offset'].x, pointer.viewportY - target['offset'].y
                        )
                    );
                }
            }, false);

            // re-enable the default draggability of the underlying map
            // when dragging has completed
            map.addEventListener('dragend', function(ev) {
                let target = ev.target;
                if (target instanceof H.map.Marker) {
                    behavior.enable();
                    let resultCoord = map.screenToGeo(
                        ev.currentPointer.viewportX,
                        ev.currentPointer.viewportY
                    );
                    // console.log(resultCoord)
                    inputLat.value = resultCoord.lat.toFixed(5);
                    inputLng.value = resultCoord.lng.toFixed(5);
                }
            }, false);
        }

        if (window.action == "submit") {
            addDragableMarker(map, behavior);
        }

        function restrictMap(map){
            let bounds = new H.geo.Rect(-6.886, 107.6045, -6.8948, 107.609);
            map.getViewModel().addEventListener('sync', function() {
            var center = map.getCenter();
            if (!bounds.containsPoint(center)) {
                if (center.lat > bounds.getTop()) {
                center.lat = bounds.getTop();
                } else if (center.lat < bounds.getBottom()) {
                center.lat = bounds.getBottom();
                }
                if (center.lng < bounds.getLeft()) {
                center.lng = bounds.getLeft();
                } else if (center.lng > bounds.getRight()) {
                center.lng = bounds.getRight();
                }
                map.setCenter(center);
            }
            });
            //Debug code to visualize where your restriction is
            map.addObject(new H.map.Rect(bounds, {
            style: {
                fillColor: 'rgba(55, 85, 170, 0.1)',
                strokeColor: 'rgba(55, 85, 170, 0.6)',
                lineWidth: 8
                }
            }
            ));
        }

        // Browse location facilities
        let facilities = [];
        const fetchFacilities = function (latitude, longitude, radius) {
            return new Promise(function (resolve, reject) {
                resolve(
                    fetch(`${window.appURL}/api/facilities?lat=${latitude}&lng=${longitude}&rad=${radius}&category[]=${category}`)
                    .then((res) => res.json())
                    .then(function(data) {
                        data.forEach(function (value, index) {
                        // Add the first marker
                        let pngIcon = new H.map.Icon(`${window.appURL}/storage/${value.icon}`, { size: { w: 40, h: 40 } });
                        let distance= value.distance;
                        let rounded = Math.round((distance + Number.EPSILON) * 100) * 10;
                        let marker = new H.map.Marker({ lat: value.latitude, lng: value.longitude}, { icon: pngIcon });
                            marker.setData(`${value.title}<br><small>Jarak: ${rounded} M</small><br><a href="${window.appURL}/fasilitas/${value.id}">Lihat Detail</a>`);
                            facilities.push(marker);
                        if(index==0){
                            document.getElementById("terdekat").innerHTML = `<a href="${window.appURL}/fasilitas/${value.id}">${value.title}`;
                        }
                        })
                        let pngIcon = new H.map.Icon(`${window.appURL}/public/assets/images/now.png`, { size: { w: 40, h: 40 } });
                        let markerNow = new H.map.Marker({ lat: objLocalCoord.lat, lng: objLocalCoord.lng}, { icon: pngIcon });
                        markerNow.setData(`Lokasi Anda`);
                        facilities.push(markerNow);
                    })
                )
            })
        }

        function clearFacilities() {
            map.removeObjects(facilities);
            facilities = [];
        }

        function init(group, latitude, longitude, radius) {
            clearFacilities();
            fetchFacilities(latitude, longitude, radius)
            .then(function () {
                group.addObjects(facilities);
            });
        }

        if (window.action == 'browse') {
            console.log(category)
            let group = new H.map.Group();
            map.addObject(group);
            group.addEventListener('tap', function (evt) {
              var bubble =  new H.ui.InfoBubble(evt.target.getGeometry(), {
                content: evt.target.getData()
              });
              ui.addBubble(bubble);
            }, false);

            map.addEventListener('dragend', function (ev) {
                let resultCoord = map.screenToGeo(
                    ev.currentPointer.viewportX,
                    ev.currentPointer.viewportY
                );
                //init(resultCoord.lat, resultCoord.lng, 40);
            }, false);

            init(group, objLocalCoord.lat, objLocalCoord.lng, 40);

        }

        let urlParams = new URLSearchParams(window.location.search);
        if (window.action == 'direction') {
            addPolylineToMap(map);
            let pngIcon = new H.map.Icon(`${window.appURL}/public/assets/images/now.png`, { size: { w: 40, h: 40 } });
            let markerStart = new H.map.Marker({ lat: urlParams.get('fromLat'), lng: urlParams.get('fromLng')}, { icon: pngIcon });
            map.addObject(markerStart);
            let pngIcon2 = new H.map.Icon(`${window.appURL}/storage/${window.facilityIcon}`, { size: { w: 40, h: 40 } });
            let markerFinish = new H.map.Marker({ lat: urlParams.get('toLat'), lng: urlParams.get('toLng')}, { icon: pngIcon2 });
            map.addObject(markerFinish);
        }

        function addPolylineToMap(map) {
            let lineString = new H.geo.LineString();
            lineString.pushPoint({lat:urlParams.get('fromLat'), lng:urlParams.get('fromLng')});
            lineString.pushPoint({lat:urlParams.get('toLat'), lng:urlParams.get('toLng')});
            
            map.addObject(new H.map.Polyline(
                lineString, { style: { lineWidth: 4 }}
            ));
        }

        

    })

    function openDirection(lat, lng, route_id,id) {
        window.open(`/rute/${route_id}/destinasi/${id}?fromLat=${objLocalCoord.lat}&fromLng=${objLocalCoord.lng}&toLat=${lat}&toLng=${lng}`, "_self");
    }

    function openDirectionPage(lat, lng, id) {
        window.open(`/fasilitas/${id}/petunjuk?fromLat=${objLocalCoord.lat}&fromLng=${objLocalCoord.lng}&toLat=${lat}&toLng=${lng}`, "_self");
    }
} else {
    console.error("Geolocation is not supported by this browser!");
}