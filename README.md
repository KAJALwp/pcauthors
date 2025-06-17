# Post CoAuthors Plugin

A WordPress plugin to manage contributors for posts. This plugin adds a meta box in the post editor to select contributors, which only users with the capability to manage posts (admins, editors, and authors) can manage and stores them as post metadata. Additionally, it ensures clean uninstallation by removing all plugin-related metadata.

![post-coauthors](https://github.com/user-attachments/assets/c1da3caa-6638-4e32-9a53-16278961875c)


---

## Features
- **Contributors Management**: Assign contributors to any post effortlessly.
- **Custom Metadata**: Saves contributor information as post metadata.
- **Admin-Friendly**: Integrates with the WordPress admin UI for a seamless experience.
- **Lightweight & Optimized**: Ensures minimal impact on site performance.

---

## Installation
1. Download the plugin or clone this repository.
2. When downloading the plugin as a ZIP file from the GitHub repository, you may notice the ZIP file name and the extracted folder name include the branch name (e.g., pcauthors-main.zip).
3. If you clone the repository directly, it will automatically create a folder named pcauthors (without the branch name), so no renaming is needed in that case.
4. If you downloaded the ZIP file, rename the extracted folder from pcauthors-main to pcauthors before uploading it to WordPress.
5. Upload the renamed folder (or the cloned folder) to your WordPress site's `wp-content/plugins` directory.
6. Activate the plugin from the WordPress Admin Dashboard.
7. Enjoy managing your contributors!

---

## Usage
1. Edit a post from your WordPress dashboard.
2. Use the **Contributors Metabox** on the righ sidebar of the post editor to select contributors.
3. Save or update the post to store the metadata.
4. Contributors will be displayed on the frontend (if theme compatibility is implemented).

---

## Libraries/References Used
The following libraries were utilized in the development of this plugin:
- [WordPress Plugin Handbook](https://developer.wordpress.org/plugins/)
- [WordPress Core Functions](https://developer.wordpress.org/)
- [WordPress Metabox](https://developer.wordpress.org/reference/functions/add_meta_box/)
- [WP_Query](https://developer.wordpress.org/reference/classes/wp_query/)

---

## Contributing
We welcome contributions! To contribute:
1. Fork the repository.
2. Create a new branch (`git checkout -b feature/my-feature`).
3. Commit your changes (`git commit -am 'Add some feature'`).
4. Push to the branch (`git push origin feature/my-feature`).
5. Create a new Pull Request.

---

## Authors
Kajal Gohel

That's it Thanks.
