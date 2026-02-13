<?php
/* Template Name: Contact Page */
get_header(); 
?>

<div class="home-container">

    <section class="hero">
        <h1 style="color:black !important;">Contact Member Platform</h1>
        <p class="subtitle">
            Get in touch for inquiries, demos, or collaborations.
        </p>
    </section>

    <section class="contact">
        <h2>Send a Message</h2>
        <form method="post" class="contact-form">
            <p>
                <label for="name">Name</label><br>
                <input type="text" id="name" name="name" required style="border:1px solid #000;">
            </p>
            <p>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" required style="border:1px solid #000;">
            </p>
            <p>
                <label for="message">Message</label><br>
                <textarea id="message" name="message" rows="5" required style="border:1px solid #000;"></textarea>
            </p>
            <p>
                <button type="submit" class="btn-primary">Send Message</button>
            </p>
        </form>
    </section>

</div>

<?php get_footer(); ?>