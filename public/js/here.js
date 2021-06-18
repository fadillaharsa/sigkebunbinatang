if (navigator.geolocation) {
    let options;
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
                    zoom: 17.5,
                    center: objUserCoord,
                    pixelRatio: window.devicePixelRatio || 1
                });
            window.addEventListener('resize', () => map.getViewPort().resize());

                         
        let ui = H.ui.UI.createDefault(map, defaultLayers);
        let zoom = ui.getControl('zoom');
        restrictMap(map);
        zoom.setAlignment('top-left');
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
            let myLink = `${window.appURL}/api/facilities?lat=${latitude}&lng=${longitude}&rad=${radius}&`;
            category.forEach((x, i) => {
            if (i === 0) {
                myLink += `category[]=${x}`;
            } else {
                myLink += `&category[]=${x}`;
            }
            });
            return new Promise(function (resolve, reject) {
                resolve(
                    fetch(myLink)
                    .then((res) => res.json())
                    .then(function(data) {
                        data.forEach(function (value, index) {
                        // Add the first marker
                        let pngIcon = new H.map.Icon(`${window.appURL}/public/storage/${value.icon}`, { size: { w: 40, h: 40 } });
                        let distance= value.distance;
                        distance = parseFloat(distance).toFixed(2);
                        let marker = new H.map.Marker({ lat: value.latitude, lng: value.longitude}, { icon: pngIcon });
                            marker.setData(`${value.title}<br><small>Jarak: ${distance} KM</small><br><a href="${window.appURL}/fasilitas/${value.id}">Lihat Detail</a>`);
                            facilities.push(marker);
                        if(index==0){
                            document.getElementById("terdekat").innerHTML = `<a href="${window.appURL}/fasilitas/${value.id}">${value.title}`;
                            sessionStorage.setItem('nearest', value.title);
                            let speak = new SpeechSynthesisUtterance();
                            speak.lang = "id-ID";
                            speak.text=`"Kamu sedang berada di"${value.title}`;
                            window.speechSynthesis.speak(speak);
                        }
                        })
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

        function addDomMarker(map) {
            var outerElement = document.createElement('div'),
            innerElement = document.createElement('div');
            outerElement.style.userSelect = 'none';
            outerElement.style.webkitUserSelect = 'none';
            outerElement.style.msUserSelect = 'none';
            outerElement.style.mozUserSelect = 'none';
            outerElement.style.cursor = 'default';
            innerElement.style.color = 'black';
            innerElement.style.backgroundColor = 'red';
            innerElement.style.border = '2px solid black';
            innerElement.style.font = 'normal 12px arial';
            innerElement.style.lineHeight = '12px'
            innerElement.style.paddingTop = '3px';
            innerElement.style.paddingLeft = '3px';
            innerElement.style.width = '25px';
            innerElement.style.height = '25px';
            innerElement.style.marginTop = '-10px';
            innerElement.style.marginLeft = '-10px';
            outerElement.appendChild(innerElement);
            innerElement.innerHTML = '⚫';
            function changeOpacity(evt) {
            evt.target.style.opacity = 0.6;
            };
            function changeOpacityToOne(evt) {
            evt.target.style.opacity = 1;
            };
            var domIcon = new H.map.DomIcon(outerElement, {
            onAttach: function(clonedElement, domIcon, domMarker) {
                clonedElement.addEventListener('mouseover', changeOpacity);
                clonedElement.addEventListener('mouseout', changeOpacityToOne);
            },
            onDetach: function(clonedElement, domIcon, domMarker) {
                clonedElement.removeEventListener('mouseover', changeOpacity);
                clonedElement.removeEventListener('mouseout', changeOpacityToOne);
            }
            });
            navigator.geolocation.getCurrentPosition(position => {
                localCoord = position.coords;
                objNowCoord = {
                    lat: localCoord.latitude,
                    lng: localCoord.longitude
                }
                var bearsMarker = new H.map.DomMarker({lat: objNowCoord.lat, lng: objNowCoord.lng}, {
                icon: domIcon
                });
                map.addObject(bearsMarker);
                navigator.geolocation.watchPosition(position => {
                    localCoord = position.coords;
                    objNowCoord = {
                        lat: localCoord.latitude,
                        lng: localCoord.longitude
                    }
                        ease(
                        bearsMarker.getGeometry(),
                        objNowCoord,
                        1000,
                        function(coord) {
                        bearsMarker.setGeometry(coord);
                        }
                    )
                    bearsMarker.setGeometry({ lat: objNowCoord.lat, lng: objNowCoord.lng });
                },error,options
                )
            },error,options
            )
            function ease(
                startCoord = {lat: 0, lng: 0},
                endCoord = {lat: 1, lng: 1},
                durationMs = 200,
                onStep = console.log,
                onComplete = function() {},
            ) {
                var raf = window.requestAnimationFrame || function(f) {window.setTimeout(f, 16)},
                    stepCount = durationMs / 16,
                    valueIncrementLat = (endCoord.lat - startCoord.lat) / stepCount,
                    valueIncrementLng = (endCoord.lng - startCoord.lng) / stepCount,
                    sinValueIncrement = Math.PI / stepCount,
                    currentValueLat = startCoord.lat,
                    currentValueLng = startCoord.lng,
                    currentSinValue = 0;
            
                function step() {
                currentSinValue += sinValueIncrement;
                currentValueLat += valueIncrementLat * (Math.sin(currentSinValue) ** 2) * 2;
                currentValueLng += valueIncrementLng * (Math.sin(currentSinValue) ** 2) * 2;
            
                if (currentSinValue < Math.PI) {
                    onStep({lat: currentValueLat, lng: currentValueLng});
                    raf(step);
                } else {
                    onStep(endCoord);
                    onComplete();
                }
                }
                raf(step);
            }
        }

        if (window.action == 'browse') {
            let group = new H.map.Group();
            map.addObject(group);
            group.addEventListener('tap', function (evt) {
              var bubble =  new H.ui.InfoBubble(evt.target.getGeometry(), {
                content: evt.target.getData()
              });
              ui.getBubbles().forEach(bub => ui.removeBubble(bub));
              ui.addBubble(bubble);
            }, false);

            map.addEventListener('dragend', function (ev) {
                let resultCoord = map.screenToGeo(
                    ev.currentPointer.viewportX,
                    ev.currentPointer.viewportY
                );
            }, false);

            init(group, objUserCoord.lat, objUserCoord.lng, 40);
            // navigator.geolocation.getCurrentPosition(position => {
            //     localCoord = position.coords;
            //     objNowCoord = {
            //         lat: localCoord.latitude,
            //         lng: localCoord.longitude
            //     }
            //     let pngIcon = new H.map.Icon(`${window.appURL}/public/assets/images/now.png`, { size: { w: 40, h: 40 } });
            //     let markerStart = new H.map.Marker({ lat: objNowCoord.lat, lng: objNowCoord.lng}, { icon: pngIcon });
            //     map.addObject(markerStart);
            // },error,options
            // )
           addDomMarker(map);
        }

        let urlParams = new URLSearchParams(window.location.search);
        if (window.action == 'direction') {
            
            navigator.geolocation.watchPosition(position => {
                localCoord = position.coords;
                objNowCoord = {
                    lat: localCoord.latitude,
                    lng: localCoord.longitude
                }
                let pngIcon = new H.map.Icon(`${window.appURL}/public/assets/images/position.png`, { size: { w: 15, h: 15 } });
                let markerNow = new H.map.Marker({ lat: objNowCoord.lat, lng: objNowCoord.lng}, { icon: pngIcon });
                map.addObject(markerNow);
            },error,options
            )
            
            navigator.geolocation.getCurrentPosition(position => {
                localCoord = position.coords;
                objNowCoord = {
                    lat: localCoord.latitude,
                    lng: localCoord.longitude
                }
                addPolylineToMap(map,objNowCoord);
                let pngIcon = new H.map.Icon(`${window.appURL}/public/assets/images/now.png`, { size: { w: 40, h: 40 } });
                let markerStart = new H.map.Marker({ lat: objNowCoord.lat, lng: objNowCoord.lng}, { icon: pngIcon });
                map.addObject(markerStart);
            },error,options
            )
            
            let pngIcon2 = new H.map.Icon(`${window.appURL}/public/storage/${window.facilityIcon}`, { size: { w: 40, h: 40 } });
            let markerFinish = new H.map.Marker({ lat: urlParams.get('toLat'), lng: urlParams.get('toLng')}, { icon: pngIcon2 });
            map.addObject(markerFinish);
            
            let pngGate = new H.map.Icon(`${window.appURL}/public/assets/images/gerbang.png`, { size: { w: 40, h: 40 } });
                let markerGate = new H.map.Marker({ lat: -6.88970, lng: 107.60790}, { icon: pngGate });
                map.addObject(markerGate);
            

        }

        function addPolylineToMap(map,objNowCoord) {
            let lineString = new H.geo.LineString();
            lineString.pushPoint({lat:objNowCoord.lat, lng:objNowCoord.lng});
            lineString.pushPoint({lat:urlParams.get('toLat'), lng:urlParams.get('toLng')});
            
            map.addObject(new H.map.Polyline(
                lineString, { style: { lineWidth: 4 }}
            ));
        }

    },error,options
    )

    function error(err) {
        console.warn('ERROR(' + err.code + '): ' + err.message);
    }
      
    options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge:10000
    };



    function openDirection(lat, lng, route_id,id) {
        window.open(`/rute/${route_id}/destinasi/${id}?fromLat=${objUserCoord.lat}&fromLng=${objUserCoord.lng}&toLat=${lat}&toLng=${lng}`, "_self");
    }

    function openDirectionPage(lat, lng, id) {
        window.open(`/fasilitas/${id}/petunjuk?fromLat=${objUserCoord.lat}&fromLng=${objUserCoord.lng}&toLat=${lat}&toLng=${lng}`, "_self");
    }

} else {
    console.error("Geolocation is not supported by this browser!");
}