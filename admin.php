<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
    <link rel="stylesheet" href="style_admin.css"> <!-- Include your stylesheet if needed -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Kanit:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">
</head>

<body>
    <div class="container">
        <h2>Contact Data</h2>
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include your database connection file
                require_once "database.php";

                // Fetch contact data from the database
                $sql = "SELECT * FROM contact_details_db";
                $result = mysqli_query($conn, $sql);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['name']}</td>";
                        echo "<td>{$row['email']}</td>";
                        echo "<td>";
                        echo "<div id='message_{$row['id']}' class='message'>";
                        echo $row['message'];
                        echo "</div>";

                        // Show "Read More" link only if the message is too long
                        if (strlen($row['message']) > 200) {
                            echo "<a id='more_link_{$row['id']}' href='javascript:void(0);' onclick='toggleMessage({$row['id']});'>Read More</a>";
                        }

                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='4'>No contact data available</td></tr>";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </div>

    <script>
        function toggleMessage(id) {
            var messageElement = document.getElementById('message_' + id);
            var moreLink = document.getElementById('more_link_' + id);

            if (messageElement.style.maxHeight) {
                messageElement.style.maxHeight = null;
                moreLink.innerHTML = 'Read More';
            } else {
                messageElement.style.maxHeight = 'none';
                moreLink.innerHTML = 'Read Less';
            }
        }
    </script>
</body>

</html>
