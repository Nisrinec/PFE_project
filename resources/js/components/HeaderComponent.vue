<template>
    <header>
        <div class="container">
            <img src="/images/s.png" alt="Website Logo" class="logo">
            <nav>
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/contactus">Contact Us</a></li>
                    <li><a href="/services">Our Services</a></li>
                    <li><a href="/login">Login</a></li>
                </ul>
            </nav>
        </div>
    </header>
</template>

<script>
export default {
    name: 'HeaderComponent'
}
</script>

<style scoped>
header {
    background-color: #ffffff;
    padding: 10px 0;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}
.container {
    display: flex;
    align-items: center;
    justify-content: center;
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 20px;
}
.logo {
    height: 50px;
    margin-right: auto;
}
nav ul {
    list-style: none;
    display: flex;
    gap: 40px; /* Adjust the gap as needed */
}
nav ul li a {
    text-decoration: none;
    color: #333333;
    font-weight: bold;
    transition: color 0.3s;
}
nav ul li a:hover {
    color: #ff0000;
}
</style>
