<!-- resources/views/usermanual/index.blade.php -->

@extends('layouts.app')
<!-- Assuming you have a master layout, adjust this based on your layout structure -->

@section('content')
    <nav id="navbar">
        <header class="main-header"></header>
        <ul>
            <li><a class="nav-link" href="#Introduction">Introduction</a></li>
            <li>
                <a class="nav-link" href="#What_you_should_already_know"> You should know : </a>
            </li>
            <li>
                <a class="nav-link" href="#JavaScript_and_Java">Users</a>
            </li>
            <li><a class="nav-link" href="#Hello_world">Products</a></li>
            <li><a class="nav-link" href="#Variables">Brands</a></li>
            <li>
                <a class="nav-link" href="#Declaring_variables">Categories</a>
            </li>
            <li><a class="nav-link" href="#Variable_scope">
                    Contacts</a></li>
            <li>
                <a class="nav-link" href="#Global_variables">Orders</a>
            </li>
            <li><a class="nav-link" href="#Constants">Dashboard</a></li>
            <li><a class="nav-link" href="#Data_types">Banners</a></li>
        </ul>
    </nav>
    <main id="main-doc">
        <section class="main-section" id="Introduction">
            <header>Introduction</header>
            <article>
                <p class="Introduction">
                    An admin panel, short for administration panel or dashboard, is a web-based interface or application
                    designed to manage and control a system, website, or application. Admin panels are commonly used in
                    various contexts, such as content management systems (CMS), e-commerce platforms, project management
                    tools, and more. They serve as a centralized hub for administrators or authorized users to oversee,
                    configure, and maintain different aspects of the underlying system.
                </p>

                <p>
                    Admin panels play a crucial role in streamlining the management and maintenance of complex systems,
                    empowering administrators to efficiently control and monitor their applications or platforms. The design
                    and functionality of an admin panel can vary based on the specific needs and requirements of the system
                    it serves.
                </p>
            </article>
        </section>
        <section class="main-section" id="What_you_should_already_know">
            <header> You already know :</header>
            <article>
                <p>This guide assumes you have the following basic background:</p>

                <ul>
                    <li>
                        A general understanding of the Internet and the World Wide Web
                        (WWW).
                    </li>
                    <li>Basic computer knowledge.</li>
                </ul>
            </article>
        </section>
        <section class="main-section" id="JavaScript_and_Java">
            <header>Users</header>
            <article>
                <p class="js-and-java">
                    This Window has 3 main operations: <br>
                <ul>
                    <li>To view the Existing users</li>
                    <li>To Edit the Existing users</li>
                    <li>To Create new users</li>
                    <br>
                </ul>
                </p>

                <h3>View Users: </h3>
                <p class="js-and-java">
                    The user window looks like :

                <div class="man-img window">
                    <img src="images/user_window1.png" alt="">
                </div>
                </p>
                <p>
                    Users can be searched by their <b>Name</b>, <b>Role</b> or <b>Status</b> <br>
                    This is shown Below: <br>
                <div class="man-img filters">
                    <img src="images/Filters.png" alt="">
                </div>
                Click on the <b>Search</b> Button after u have selected the search criteria. <br><br>
                </p>

                <p>
                    To get more info about the user <b>Click</b> on the user's card <br>
                    The Following popup will appear:
                <div class="man-img info-card">
                    <img src="images/info_card.png" alt="">
                </div>
                </p>

                <h3>Edit User: </h3>
                <p>To <b>Edit</b> an existing user click on the edit icon on the users card
                <div class="man-img edit-icon">
                    <img src="images/edit_icon.png" alt="">
                </div>
                The <b>Edit Popup window</b> will appear and have the following:
                <div class="man-img edit-popup">
                    <img src="images/edit_popup.png" alt="">
                </div>
                After filling the form in the popup click on <b>Update user</b> to update the users details <br><br>
                Click on <b>Delete</b> button to delete the selected user from the database.
                <br><br>
                </p>

                <h3>Create user:</h3>
                <br>
                <p>
                    To <b>Create</b> a new user click on the create icon present on the bottom right of the user window.
                <div class="man-img create-icon">
                    <img src="images/create_icon.png" alt="">
                </div>
                The <b>Create Popup window</b> will appear and will have the following:
                <div class="man-img create-popup">
                    <img src="images/create_popup.png" alt="">
                </div>
                After filling the form in the popup click on <b>Save user</b> to add the new user into the database. <br>
                </p>
            </article>
        </section>
        <section class="main-section" id="Hello_world">
            <header>Products</header>
            <article>
                <p class="js-and-java">
                    This Window has 3 main operations: <br>
                <ul>
                    <li>To view the Existing Products</li>
                    <li>To Edit the Existing Products</li>
                    <li>To Add new Products</li>
                    <br>
                </ul>
                </p>
                <h3>View Products: </h3>
                <p class="js-and-java">
                    The Product window looks like :

                <div class="man-img window">
                    <img src="images/product_window.png" alt="">
                </div>
                </p>
                <p>
                    Products can be searched by it's <b>Name</b> or <b>Status</b> <br>
                    This is shown Below: <br>
                <div class="man-img filters">
                    <img src="images/product_filters.png" alt="">
                </div>
                Click on the <b>Search</b> Button after u have selected the search criteria. <br><br>
                </p>

                <p>
                    To get more info about the product <b>Click</b> on the product's card <br>
                    The Following popup will appear:
                <div class="man-img info-card">
                    <img src="images/product_info.png" alt="">
                </div>
                </p>

                <h3>Edit Product: </h3>
                <p>To <b>Edit</b> an existing product click on the edit icon on the product's card
                <div class="man-img edit-icon">
                    <img src="images/product_edit.png" alt="">
                </div>
                The <b>Edit Popup window</b> will appear and have the following:
                <div class="man-img edit-popup">
                    <img src="images/product_epopup.png" alt="">
                </div>
                After filling the form in the popup click on <b>Update product</b> to update the product's details <br><br>
                Click on <b>Delete</b> button to delete the selected Product from the database.
                <br><br>
                </p>

                <h3>Add Product:</h3>
                <br>
                <p>
                    To <b>Add</b> a new product click on the create icon present on the bottom right of the user window.
                <div class="man-img create-icon">
                    <img src="images/Product_add.png" alt="">
                </div>
                Products can be added <b>individually</b> or by <b>importing</b> a file. <br>

                The <b>Create Popup window</b> will appear and will have the following:
                <div class="man-img create-popup">
                    <img src="images/product_addpopup.png" alt="">
                </div>
                After filling the form in the popup click on <b>Save product</b> to add the new user into the database. <br>
                </p>

            </article>
        </section>
        <section class="main-section" id="Variables">
            <header>Brands</header>
            <p class="js-and-java">
                This Window has 3 main operations: <br>
            <ul>
                <li>To view the Existing Brands</li>
                <li>To Edit the Existing Brands</li>
                <li>To Add new Brands</li>
                <br>
            </ul>
            </p>
            <h3>View Brands: </h3>
            <p class="js-and-java">
                The Brand window looks like :

            <div class="man-img window">
                <img src="images/brand_window.png" alt="">
            </div>
            </p>
            <p>
                Brands can be searched by it's <b>Name</b> or <b>Status</b> <br>
                This is shown Below: <br>
            <div class="man-img filters">
                <img src="images/product_filters.png" alt="">
            </div>
            Click on the <b>Search</b> Button after u have selected the search criteria. <br><br>
            </p>

            <p>
                To get more info about the Brand <b>Click</b> on the brand's card <br>
                The Following popup will appear:
            <div class="man-img info-card">
                <img src="images/brand_info.png" alt="">
            </div>
            </p>

            <h3>Edit Brand: </h3>
            <p>To <b>Edit</b> an existing brand click on the edit icon on the brand's card
            <div class="man-img edit-icon">
                <img src="images/product_edit.png" alt="">
            </div>
            The <b>Edit Popup window</b> will appear and have the following:
            <div class="man-img edit-popup">
                <img src="images/brand_epopup.png" alt="">
            </div>
            After filling the form in the popup click on <b>Update brand</b> to update the brand's details <br><br>
            Click on <b>Delete</b> button to delete the selected Brand from the database.
            <br><br>
            </p>
            <h3>Add brand:</h3>
            <br>
            <p>
                To <b>Add</b> a new Brand click on the Add icon present on the bottom right of the user window.
            <div class="man-img create-icon">
                <img src="images/brand_add.png" alt="">
            </div>
            The <b>Create Popup window</b> will appear and will have the following:
            <div class="man-img create-popup">
                <img src="images/brand_apopup.png" alt="">
            </div>
            After filling the form in the popup click on <b>Save Brand</b> to add the new brand into the database. <br>
            </p>
        </section>
        <section class="main-section" id="Declaring_variables">
            <header>Categories</header>
            <article>
                <p class="js-and-java">
                    This Window has 3 main operations: <br>
                <ul>
                    <li>To view the Existing Categories</li>
                    <li>To Edit the Existing Categories</li>
                    <li>To Add new Categories</li>
                    <br>
                </ul>
                </p>
                <h3>View Categories: </h3>
                <p class="js-and-java">
                    The category window looks like :

                <div class="man-img window">
                    <img src="images/category_window.png" alt="">
                </div>
                </p>
                <p>
                    Categories can be searched by it's <b>Name</b> or <b>Status</b> <br>
                    This is shown Below: <br>
                <div class="man-img filters">
                    <img src="images/product_filters.png" alt="">
                </div>
                Click on the <b>Search</b> Button after u have selected the search criteria. <br><br>
                </p>

                <p>
                    To get more info about the Category <b>Click</b> on the Category's card <br>
                    The Following popup will appear:
                <div class="man-img info-card">
                    <img src="images/category_info.png" alt="">
                </div>
                </p>

                <h3>Edit Category: </h3>
                <p>To <b>Edit</b> an existing category click on the edit icon on the brand's card
                <div class="man-img edit-icon">
                    <img src="images/product_edit.png" alt="">
                </div>
                The <b>Edit Popup window</b> will appear and have the following:
                <div class="man-img edit-popup">
                    <img src="images/category_epopup.png" alt="">
                </div>
                After filling the form in the popup click on <b>Update category</b> to update the category's details
                <br><br>
                Click on <b>Delete</b> button to delete the selected Category from the database.
                <br><br>
                </p>
                <h3>Add category:</h3>
                <br>
                <p>
                    To <b>Add</b> a new Category click on the Add icon present on the bottom right of the user window.
                <div class="man-img create-icon">
                    <img src="images/brand_add.png" alt="">
                </div>
                The <b>Create Popup window</b> will appear and will have the following:
                <div class="man-img create-popup">
                    <img src="images/category_apopup.png" alt="">
                </div>
                After filling the form in the popup click on <b>Save Category</b> to add the new category into the database.
                <br>
                </p>
            </article>
        </section>
        <section class="main-section" id="Variable_scope">
            <header>Contacts</header>
            <article>
                <p class="js-and-java">
                    This Window has 3 main operations: <br>
                <ul>
                    <li>To view the Existing Contacts</li>
                    <li>To Edit the Existing Contacts</li>
                    <li>To Add new Contacts</li>
                    <br>
                </ul>
                </p>
                <h3>View Contacts: </h3>
                <p class="js-and-java">
                    The contacts window looks like :

                <div class="man-img window">
                    <img src="images/contacts-window.png" alt="">
                </div>
                </p>
                <p>
                    Contacts can be searched by it's <b>Name</b> or <b>Status</b> <br>
                    This is shown Below: <br>
                <div class="man-img filters">
                    <img src="images/product_filters.png" alt="">
                </div>
                Click on the <b>Search</b> Button after u have selected the search criteria. <br><br>
                </p>

                <p>
                    To get more info about the Contact <b>Click</b> on the Contact's card <br>
                    The Following popup will appear:
                <div class="man-img info-card">
                    <img src="images/contacts_info.png" alt="">
                </div>
                </p>

                <h3>Edit Contact: </h3>
                <p>To <b>Edit</b> an existing contact click on the edit icon on the contact's card
                <div class="man-img edit-icon">
                    <img src="images/contacts_edit.png" alt="">
                </div>
                The <b>Edit Popup window</b> will appear and have the following:
                <div class="man-img edit-popup">
                    <img src="images/contacts_epopup.png" alt="">
                </div>
                After filling the form in the popup click on <b>Update contact</b> to update the contact's details <br><br>
                Click on <b>Delete</b> button to delete the selected Contact from the database.
                <br><br>
                </p>
                <h3>Add contact:</h3>
                <br>
                <p>
                    To <b>Add</b> a new Contact click on the Add icon present on the bottom right of the user window.
                <div class="man-img create-icon">
                    <img src="images/brand_add.png" alt="">
                </div>
                The <b>Create Popup window</b> will appear and will have the following:
                <div class="man-img create-popup">
                    <img src="images/contacts_apopup.png" alt="">
                </div>
                After filling the form in the popup click on <b>Save Contact</b> to add the new category into the database.
                <br>
                </p>
            </article>
        </section>
        <section class="main-section" id="Global_variables">
            <header>Orders</header>
            <article>
                <p class="js-and-java">
                    This window is used to view the orders made by the customer. <br><br>
                    The contacts window looks like :

                <div class="man-img window">
                    <img src="images/order_window.png" alt="">
                </div>
                </p>

                <p>
                    Orders can be searched by it's <b>Name</b> or <b>Status</b> <br>
                    This is shown Below: <br>
                <div class="man-img order-filter">
                    <img src="images/order_filter.png" alt="">
                </div>
                Click on the <b>Search</b> Button after u have selected the search criteria. <br><br>
                </p>

                <p>
                    Consequently, you can access global variables declared in one window
                    or frame from another window or frame by specifying the window or
                    frame name. For example, if a variable called phoneNumber is
                    declared in a document, you can refer to this variable from an
                    iframe as parent.phoneNumber.
                </p>
            </article>
        </section>
        <section class="main-section" id="Constants">
            <header>Dashboard</header>
            <article>
                <p class="js-and-java">
                    A dashboard is a visual representation of key performance indicators (KPIs), metrics, and data points
                    that provide a real-time overview of the status and performance of a system, process, or business.
                    Dashboards are widely used across various industries and domains to help decision-makers quickly and
                    efficiently monitor and analyze data. <br><br>
                    The dashboard window looks like :

                <div class="man-img window">
                    <img src="images/dashboard_window.png" alt="">
                </div>
                </p>
            </article>
        </section>
        <section class="main-section" id="Data_types">
            <header>Banners</header>

            <article>
                <p class="js-and-java">
                    This Window has 3 main operations: <br>
                <ul>
                    <li>To view the Existing Banners</li>
                    <li>To Edit the Existing Banners</li>
                    <li>To Add new Banners</li>
                    <br>
                </ul>
                </p>
                <p class="js-and-java">
                    The contacts window looks like :

                <div class="man-img window">
                    <img src="images/banner_window.png" alt="">
                </div>
                </p>
                <h3>View Banner:</h3>
                <p>
                    Click on the <b>Show</b> button to view more info about the banner in a popup window.
                <div class="man-img info-card">
                    <img src="images/banner_info.png" alt="">
                </div>
                </p>
                <h3>Edit Banner: </h3>
                <p>To <b>Edit</b> an existing contact click on the edit Button. <br><br>
                    The <b>Edit Popup window</b> will appear and have the following:
                <div class="man-img edit-popup">
                    <img src="images/banner_epopup.png" alt="">
                </div>
                After filling the form in the popup click on <b>Update Banner</b> to update the Banner's details <br><br>
                Click on <b>Delete</b> button to delete the Banner from the database.
            </article>

        </section>
    @endsection
