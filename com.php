<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $event = htmlspecialchars($_POST['event']);
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    // Owner's email address
    $owner_email = "community@owujupe.com"; // Replace with actual owner's email

    // Subject
    $subject = "New Event Registration";

    // Email content for owner
    $owner_content = "Event: $event\n";
    $owner_content .= "Name: $name\n";
    $owner_content .= "Email: $email\n";
    $owner_content .= "Message: $message\n";

    // Email content for registrant
    $registrant_content = "Dear $name,\n\nThank you for registering for the $event event. Here is the information you provided:\n\n";
    $registrant_content .= "Name: $name\n";
    $registrant_content .= "Email: $email\n";
    $registrant_content .= "Message: $message\n\n";
    $registrant_content .= "We look forward to seeing you at the event!\n\nBest regards,\nThe Event Team\nOwujupe Inc.\nhttps://owujupe.com";

    // Headers for the registrant's email
    $registrant_headers = "From: community@owujupe.com\r\n";
    $registrant_headers .= "Reply-To: community@owujupe.com\r\n";

    // Headers for the owner's email
    $owner_headers = "From: $email\r\n";
    $owner_headers .= "Reply-To: $email\r\n";

    // Send email to registrant
    mail($email, "Registration Confirmation for $event", $registrant_content, $registrant_headers);

    // Send email to owner
    mail($owner_email, $subject, $owner_content, $owner_headers);

   header("Location: https://owujupe.com/community.html?status=success");
} else {
    echo "Invalid request method.";
}
?>
