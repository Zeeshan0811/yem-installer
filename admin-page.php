<?php
// Add Admin Page
// add_action('admin_menu', 'yem_installer_add_admin_page');

// function yem_installer_add_admin_page() {
//     add_options_page('YEM Installer', 'YEM Installer', 'manage_options', 'yem-installer', 'yem_installer_render_admin_page');
// }

// Add plugin menu page to the sidebar menu
add_action('admin_menu', 'yem_installer_add_menu_page');

function yem_installer_add_menu_page()
{
    add_menu_page(
        'YEM Installer',            // Page title
        'YEM Installer',            // Menu title
        'manage_options',           // Capability required
        'yem-installer',            // Menu slug
        'yem_installer_render_admin_page', // Callback function
        'dashicons-admin-plugins',  // Icon (optional)
        75                          // Position in the menu
    );
}

// Render Admin Page
function yem_installer_render_admin_page()
{
    $content = get_option('yem_content');
?>
    <div class="wrap">
        <div class="yem-form-container">
            <h2>YEM Installer</h2>
            <form id="yem-form" method="post" action="">
                <div class="yem-form-group">
                    <label for="yem_content">Paste the script here:</label><br>
                    <textarea id="yem_content" name="yem_content" rows="10" cols="50"><?php echo $content; ?></textarea>
                </div>
                <div class="yem-form-group submit_btn">
                    <input type="submit" name="submit" value="Save" class="button button-primary">
                </div>
            </form>
        </div>
    </div>
<?php
}

// Handle Form Submission
if (isset($_POST['submit'])) {
    // $content = sanitize_text_field($_POST['yem_content']);
    $content = wp_kses($_POST['yem_content'], array(
        'script' => array(
            'type' => true,
            'src' => true,
            'defer' => true,
            'async' => true,
        ),
        'style' => true,
        'div' => array(
            'class' => true,
            'id' => true,
        ),
        // Add more allowed tags as needed
    ));
    update_option('yem_content', $content);
}


// Include Content in Frontend
add_action('wp_head', 'yem_installer_include_content');

function yem_installer_include_content()
{
    // echo "Yem_hello_world";
    $content = get_option('yem_content');
    if (!empty($content)) {
        echo $content;
    }
}


// Enqueue Stylesheet
add_action('admin_enqueue_scripts', 'yem_installer_enqueue_styles');

function yem_installer_enqueue_styles()
{
    wp_enqueue_style('yem-installer-style', plugins_url('style.css', __FILE__));
}
