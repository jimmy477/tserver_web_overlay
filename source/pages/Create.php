<?php
/*
Deletes cookie if it is set.
Used for logout, when logout is clicked on another page it
redirects to this page and then deletes the cookie.
*/
if (!isset($_COOKIE['loggedin'])) {
    header("Location: Login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <!-- CSS -->
        <link rel="stylesheet" href="../css/Create.css">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

        <!-- JavaScript -->
        <script src="../js/AJAX.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <title>Create</title>
        <meta name="viewport" content="width=device-width, initial-scale=1" charset="UTF-8">
    </head>
    <body>
        <!-- Navigation bar -->
        <nav class="navbar navbar-expand navbar-light bg-light">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="Create.php">Create Event </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Events.php">Events <span class="sr-only">(current)</span></a>
                    </li>
                </ul>
                <form class="form-inline my-2 my-lg-0">
                    <a class="btn btn-outline-danger" href="Login.php" role="button">Logout</a>
                </form>
            </div>
        </nav>

        <div class="container">
            <div class="row justify-content-md-center">
                <div class="col-md-auto">
                    <h1> Create Event </h1>

                    <!-- progressbar -->
                    <ul id="progressbar">
                        <li id="details-progress">Details</li>
                        <li id="actions-progress">Actions</li>
                        <li id="review-progress">Review</li>
                    </ul>
                    <div class="progress">
                        <div id="progressanimate" class="progress-bar progress-bar-striped progress-bar-animated" style="width: 33%"></div>
                    </div>

                    <br /><br />

                    <!-- Details form -->
                    <div id="F1">
                        <div class="container">
                            <h2> Event Details </h2>
                        </div>

                        <br>

                        <form id="DetailsForm">
                            <div class="form-group">
                                <label for="test_date">Test Date</label>
                                <input class="form-control" type="date" name="test_date" id="test_date" required/>
                            </div>

                            <br/>

                            <div class="form-group">
                                <label for="test_name">Test Name</label>
                                <input class="form-control" type="text" placeholder="Enter Name" name="test_name"
                                       id="test_name" required/>
                            </div>

                            <br/>

                            <div class="row align-items-end">
                                <div class="col-8">
                                    <label for="test_room">Room</label>
                                    <ul id="room_select">
                                    </ul>
                                    <input class="form-control" list="rooms" placeholder="-- Select Rooms --"
                                           id="test_room" name="test_room">
                                    <datalist id="rooms" required>
                                        <option value="" disabled selected> -- Select A Room --</option>
                                    </datalist>
                                </div>
                                <div class="col-4">
                                    <input type="button" onclick="addRoom()" value="+ Add" class="btn btn-secondary"/>
                                </div>
                            </div>

                            <br/>
                            <br/>

                            <div class="form-group">
                                <label for="test_stime">Start Time</label>
                                <input class="form-control" type="time" name="test_stime" id="test_stime" required/>
                            </div>

                            <br/>

                            <input type="submit" value="Add Actions >" class="btn btn-primary"/>
                        </form>
                    </div>

                    <!-- Actions form -->
                    <div id="F2">
                        <div class="container">
                            <h2> Event Actions </h2>

                            <form id="ActionsForm">

                                <div class="form-group">
                                    <ul id="ActionsList"></ul>

                                    <label for="clusters_list">Cluster</label>
                                    <input class="form-control" list="clusters_list"
                                           placeholder="-- Select a Cluster --" id="action_cluster" required>
                                    <!--name="test_room">-->
                                    <datalist id="clusters_list" required>
                                    </datalist>
                                </div>

                                <div class="form-group">
                                    <label for="OffsetInput">Action time</label>
                                    <input class="form-control" id="OffsetInput" type="time" required>
                                </div>

                                <div class="form-group">
                                    <label for="Activate">Activation</label>
                                    <select class="form-control" id="Activate" required>
                                        <option value="1">Turn on</option>
                                        <option value="0">Turn off</option>
                                    </select>
                                </div>

                                <input type="submit" id="AddAction" value="+ Add Action" class="btn btn-secondary"/>
                                </br></br>
                                <input type="button" onclick="prevStep()" value="< Event Details"
                                       class="btn btn-primary"/>
                                <input type="button" onclick="reviewForm()" value="Review Event >"
                                       class="btn btn-primary"/>
                            </form>
                        </div>
                    </div>

                    <!-- Event review form -->
                    <div id="F3">
                        <div class="container">
                            <h2> Event Review </h2>

                            <br> <br>

                            <form id="ReviewForm">
                                <h4>Test Name: </h4>
                                <div id="r_name"></div>
                                <br/>
                                <h4>Test Rooms: </h4>
                                <div id="r_rooms"></div>
                                <br/>
                                <h4>Test Date: </h4>
                                <div id="r_date"></div>
                                <br/>
                                <h4>Test Start Time: </h4>
                                <div id="r_stime"></div>
                                <br/><br/>

                                <h3 class="text-center">Actions</h3>
                                <ul id="ActionsReviewList">
                                </ul>
                                <br/> <br/>

                                <input type="button" onclick="prevStep()" value="< Add Actions"
                                       class="btn btn-primary"/>
                                <input type="submit" value="Create Event" class="btn btn-success"/>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            const ON = "block";
            const OFF = "none";

            let ROOMS = [];
            let roomsAdded = 0;
            let roomsSelected = [];

            let ACTIONS = [];

            // Variables to change the state of the page
            let currentForm = 0;
            let formIds = ["F1", "F2", "F3"];

            // JSON object for storing the event
            let eventObj = {Date: "", Name:"", Rooms:[], StartTime: ""};

            // Make a get request to the URL
            makeRequest("GET", "Create_Helper.php?item=Rooms", roomCallback);
            makeRequest("GET", "Create_Helper.php?item=Clusters", clusterCallback);
            setForms();

            /**
             * To remove a room
             * */
            $('body').on("click", ".close", function() {
                let roomName = $(this).attr('id');
                removeRoom(roomName);
            });

            function removeRoom(roomName) {
                let roomIndex = roomsSelected.indexOf(roomName);
                if (roomIndex > -1) {
                    roomsSelected.splice(roomIndex, 1);
                }
                document.getElementById(roomName).remove();
                console.log(roomsSelected);

                ROOMS.push(roomName);
                roomCallback(ROOMS.sort());
            }

            /**
             * Next step function for the 1st page (Details)
             */
            $('#DetailsForm').submit(function () {
                let rooms = document.getElementById("room_select");
                if (rooms.getElementsByTagName("li").length > 0) {
                    eventObj["Date"] = $("#test_date").val();
                    console.log($("#test_name").val());
                    eventObj["Name"] = $("#test_name").val();
                    eventObj["Rooms"] = roomsSelected;
                    eventObj["StartTime"] = $("#test_stime").val();
                    currentForm++;
                    setForms();
                } else {
                    alert("You must add at least one room.");
                }
                return false;
            });

            /**
             * Next step function for the 2nd page (Type)
            */
            $('#TypeForm').submit(function () {
                currentForm++;
                setForms();
                return false;
            });

            /**
             * Next step function for the 3rd page (Actions)
             */
            $('#ActionsForm').submit(function () {
                addAction()
                return false;
            });

            /**
             * Next step function for the 4th page (Review)
             */
            $('#ReviewForm').submit(function () {
                createEvent();
                return false;
            });

            /**
             * Function for the back button to go back a step
             */
            function prevStep() {
                if (currentForm == 1) {
                    eventObj["TestType"] = $("#test_type").val();
                }
                console.log(eventObj);

                currentForm--;
                setForms();
            }

            /**
             * gets the actions given in the action list and checks if valid
             */
            function reviewForm() {
                let actions = document.getElementById("ActionsList");
                let actionsValid = checkActions();
                if (actions.getElementsByTagName("li").length > 0 && actionsValid) {
                    currentForm ++;
                    setForms();
                } else {
                    alert("The actions entered are invalid.");
                }
            }

            /**
             * Toggle between the forms.
             */
            function setForms() {
                for (let i=0; i<formIds.length; i++) {
                    let ele = document.getElementById(formIds[i]);
                    for (let x of ele.children) {
                        x.style.display = (i == currentForm) ? ON : OFF;
                    }
                }
                $("#progressanimate").css('width', `${(currentForm * 33) + 33}%`);

                if (currentForm == 0) {
                    $('#details-progress').css("font-weight", "bold");
                    $('#actions-progress').css("font-weight", "normal");
                    $('#review-progress').css("font-weight", "normal");
                } else if (currentForm == 1) {
                    $('#details-progress').css("font-weight", "normal");
                    $('#actions-progress').css("font-weight", "bold");
                    $('#review-progress').css("font-weight", "normal");
                } else if (currentForm == 2) {
                    $('#details-progress').css("font-weight", "normal");
                    $('#actions-progress').css("font-weight", "normal");
                    $('#review-progress').css("font-weight", "bold");
                    updateFinalForm();
                }
            }

            /**
             * Updates the final form with the data the user has inputted.
             */
            function updateFinalForm() {
                $("#r_name").html(eventObj["Name"]);
                $("#r_date").html(eventObj["Date"]);
                $("#r_rooms").html(eventObj["Rooms"]);
                $("#r_stime").html(eventObj["StartTime"]);

                $("#ActionsReviewList").empty();
                for (let action of ACTIONS) {
                    $("#ActionsReviewList").append("<li> Cluster: " + action["ClusterName"] + " Time: " + action["Time"] + " Activation: " + action["Activation"]);
                }
            }

            function createEvent() {
                let jsonStr = JSON.stringify(eventObj);
                console.log(jsonStr);
                $.ajax({
                    url: "Create_Helper.php",
                    type: "post",
                    data: {"event": jsonStr},
                    success: created
                });
            }

            function created(responseText) {
                console.log(responseText);

                // Get these from responseText
                let eventID = responseText;
                for (let action of ACTIONS) {
                    action["EventID"] = eventID;
                    action["StartTime"] = eventObj["StartTime"]
                    let jsonStr = JSON.stringify(action);
                    console.log(jsonStr);
                    $.ajax({
                        url: "Create_Helper.php",
                        type: "post",
                        data: {"action": jsonStr},
                        success: final
                    });
                }

            }

            function final(responseText) {
                console.log(responseText);
                document.location.href = "Events.php";
            }

            /**
             * Function to add the rooms in response text to the datalist in the webpage.
             **/
            function roomCallback(responseText) {
                let selectElement = document.getElementById('rooms');
                $('#rooms').empty();


                console.log(selectElement.style.display);
                console.log(responseText);
                if (Array.isArray(responseText)){
                    console.log(responseText);
                    var rooms = responseText;
                } else {
                    var rooms = JSON.parse(responseText);
                    console.log(123);
                    ROOMS = rooms;
                }
                for (let i=0; i<rooms.length; i++) {
                    let option = document.createElement('option');
                    option.value = rooms[i];
                    option.innerHTML = rooms[i];
                    selectElement.appendChild(option);
                }
            }

            /**
             * If the input from datalist is valid then add it to the selected rooms.
             */
            function addRoom()
            {
                let input = document.getElementById("test_room");
                if (ROOMS.includes(input.value)) {
                    roomsSelected.push(input.value);
                    let closeBtn = document.createElement('button');
                    closeBtn.className = 'close';
                    closeBtn.id = input.value;
                    closeBtn.type = 'button';
                    closeBtn.innerHTML = '×'
                    let room = document.createElement('li');
                    room.innerHTML = input.value;
                    room.id = input.value;
                    room.appendChild(closeBtn);
                    $("#room_select").append(room);

/*                    // Remove option for this room so it can't be selected more than once
                    let dList = document.getElementById("rooms");
                    for (let i=0; i<dList.children.length; i++) {
                        if (dList.children[i].value === input.value) {
                            dList.children[i].remove();
                            break;
                        }
                    }*/

                    ROOMS.splice(ROOMS.indexOf(input.value), 1);
                    input.value = "";

                    roomCallback(ROOMS);
                }
            }



            function addAction() {
                let clusterName = $("#action_cluster").val();
                let time = $("#OffsetInput").val();
                let activation = ($("#Activate").val() == "0") ? 0 : 1;
                if (ACTIONS.length == 0) {
                    $("#ActionsForm").prepend("<h3> Actions: </h3>");
                }

                $("#ActionsList").append("<li> Cluster: " + clusterName + " Time: " + time + " Activation: " + activation);
                let actionsObj = {
                    "ClusterName": clusterName,
                    "Time": time,
                    "Activation": activation
                }
                ACTIONS.push(actionsObj);
            }

            /**
             * Function for checking that for every activation of a cluster there is a corresponding deactivation.
             **/
            function checkActions() {
                let valid = true;

                for (let action of ACTIONS) {
                    let clusterActivations = ACTIONS.filter((act) => {
                        return act["ClusterName"] === action["ClusterName"] && act["Activation"] === 1;
                    }).length;

                    let clusterDeactivations = ACTIONS.filter((act) => {
                        return act["ClusterName"] === action["ClusterName"] && act["Activation"] !== 1;
                    }).length;

                    if (clusterActivations !== clusterDeactivations) {
                        valid = false;
                    }
                }

                return valid;
            }

            /**
             * Function to add the clusters to the cluster dropdown in actions form
             * @param responseText response from the server
             */
            function clusterCallback(responseText) {
                console.log(responseText);
                let selectElement = document.getElementById('clusters_list');
                // NEED TO CATCH ERROR IF PARSE FAILS
                let clusters = JSON.parse(responseText);
                for (let i = 0; i < clusters.length; i++) {
                    let option = document.createElement('option');
                    console.log(clusters[i][1]);
                    option.value = clusters[i][1];
                    option.innerHTML = clusters[i][1];
                    selectElement.appendChild(option);
                }
            }
        </script>
    </body>
</html>