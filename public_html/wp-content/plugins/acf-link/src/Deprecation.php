<?php

namespace Emrl\AcfLink;

class Deprecation
{
    public function __construct()
    {
        add_action('admin_notices', [$this, 'notices']);
        add_action('admin_menu', function () {
            add_submenu_page(
                'options-writing.php',
                'ACF Link Migration',
                null,
                'activate_plugins',
                'acf_link_run_migration',
                [$this, 'migrationPage']
            );
        });
    }

    public function notices()
    {
        if (
            class_exists('acf_field_link') &&
            current_user_can('activate_plugins') &&
            get_current_screen()->id !== 'admin_page_acf_link_run_migration'
        ) {
            if (get_option('acf_link_migration_complete', false)) {
                printf('
                    <div class="notice notice-warning is-dismissible">
                        <p>
                            Advanced Custom Fields Pro 5.6.0 now includes a built-in Link field,
                            and makes the ACF Link plugin obsolete.
                        </p>
                        <p>
                            <strong>You have successfully migrated your data, now please deactivate/delete the
                            <a href="%s"><code>Advanced Custom Fields: Link</code> plugin</a>. All link fields will be preserved.</strong>
                        </p>
                    </div>
                ', admin_url('plugins.php'));
            } else {
                printf('
                    <div class="notice notice-warning">
                        <p>
                            Advanced Custom Fields Pro 5.6.0 now includes a built-in Link field,
                            and makes the ACF Link plugin obsolete.
                        </p>
                        <p>
                            <strong>To preserve your data, please run the migration and then deactivate/delete the
                            <code>Advanced Custom Fields: Link</code> plugin.</strong>
                        </p>
                        <p><strong>REMEMBER TO BACKUP YOUR DATABASE BEFORE RUNNING THE MIGRATION.</strong></p>
                        <p>
                            <a href="%s" class="button-primary">Run Migration</a>
                        </p>
                    </div>
                ', wp_nonce_url(admin_url('admin.php?page=acf_link_run_migration'), 'acf_link_run_migration'));
            }
        }
    }

    public function migrationPage() {
        global $wpdb;

        check_admin_referer('acf_link_run_migration');

        echo '
            <div class="wrap">
                <h1>ACF Link Migration</h1>
        ';

        $run = true;
        $migrated = get_option('acf_link_migration_complete', false);

        $formatTarget = function ($target) {
            if ($target === '1') {
                $target = '_blank';
            } elseif ($target === '0') {
                $target = '';
            }
            return $target;
        };

        $replaceCommentMeta = function ($name) use ($wpdb, $run, $formatTarget) {
            if ( ! $run) {
                echo "\nMigrating comments\n";
            }

            $rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->commentmeta WHERE meta_key = %s", $name), ARRAY_A);

            foreach ($rows as $row) {
                $value = maybe_unserialize($row['meta_value']);
                if (is_array($value) && isset($value['target'])) {
                    $orig = $value['target'];
                    $value['target'] = $formatTarget($value['target']);

                    if ($orig !== $value['target']) {
                        if ($run) {
                            update_field($name, $value, 'comment_'.$row['comment_id']);
                        } else {
                            echo "    Updating comment #{$row['comment_id']} link target from '{$orig}' to '{$value['target']}'\n";
                        }
                    }
                }
            }
        };

        $replacePostmeta = function ($name) use ($wpdb, $run, $formatTarget) {
            if ( ! $run) {
                echo "\nMigrating posts\n";
            }

            $rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->postmeta WHERE meta_key = %s", $name), ARRAY_A);

            foreach ($rows as $row) {
                $value = maybe_unserialize($row['meta_value']);
                if (is_array($value) && isset($value['target'])) {
                    $orig = $value['target'];
                    $value['target'] = $formatTarget($value['target']);

                    if ($orig !== $value['target']) {
                        if ($run) {
                            update_field($name, $value, $row['post_id']);
                        } else {
                            echo "    Updating post #{$row['post_id']} link target from '{$orig}' to '{$value['target']}'\n";
                        }
                    }
                }
            }
        };

        $replaceTermmeta = function ($name) use ($wpdb, $run, $formatTarget) {
            if ( ! $run) {
                echo "\nMigrating terms\n";
            }

            $rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->termmeta WHERE meta_key = %s", $name), ARRAY_A);

            foreach ($rows as $row) {
                $value = maybe_unserialize($row['meta_value']);
                if (is_array($value) && isset($value['target'])) {
                    $orig = $value['target'];
                    $value['target'] = $formatTarget($value['target']);

                    if ($orig !== $value['target']) {
                        if ($run) {
                            update_field($name, $value, 'term_'.$row['term_id']);
                        } else {
                            echo "    Updating term #{$row['post_id']} link target from '{$orig}' to '{$value['target']}'\n";
                        }
                    }
                }
            }
        };

        $replaceUsermeta = function ($name) use ($wpdb, $run, $formatTarget) {
            if ( ! $run) {
                echo "\nMigrating users\n";
            }

            $rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->usermeta WHERE meta_key = %s", $name), ARRAY_A);

            foreach ($rows as $row) {
                $value = maybe_unserialize($row['meta_value']);
                if (is_array($value) && isset($value['target'])) {
                    $orig = $value['target'];
                    $value['target'] = $formatTarget($value['target']);

                    if ($orig !== $value['target']) {
                        if ($run) {
                            update_field($name, $value, 'user_'.$row['user_id']);
                        } else {
                            echo "    Updating user #{$row['user_id']} link target from '{$orig}' to '{$value['target']}'\n";
                        }
                    }
                }
            }
        };

        $replaceOptions = function ($name) use ($wpdb, $run, $formatTarget) {
            if ( ! $run) {
                echo "\nMigrating options\n";
            }

            $rows = $wpdb->get_results($wpdb->prepare("SELECT * FROM $wpdb->options WHERE option_name = %s", $name), ARRAY_A);

            foreach ($rows as $row) {
                $value = maybe_unserialize($row['meta_value']);
                if (is_array($value) && isset($value['target'])) {
                    $orig = $value['target'];
                    $value['target'] = $formatTarget($value['target']);

                    if ($orig !== $value['target']) {
                        if ($run) {
                            update_field($name, $value, 'option_'.$row['option_name']);
                        } else {
                            echo "    Updating option #{$row['option_name']} link target from '{$orig}' to '{$value['target']}'\n";
                        }
                    }
                }
            }
        };

        if ( ! $run) {
            echo '<div style="white-space: pre-wrap;">';
            echo "THIS IS A DRY-RUN/SIMULATION\n";
            echo "Append `&run_migration` to the URL to actually run the migration\n";
            echo "after you have verified what will happen is correct\n";
            echo "\nMigration begin\n";
        }

        if ($migrated === false) {
            foreach (acf_get_field_groups() as $group) {
                foreach (acf_get_fields($group) as $field) {
                    if ($field['type'] !== 'link') {
                        continue;
                    }

                    if ( ! $run) {
                        echo "\n----------\n";
                        echo "\nFound field: {$field['label']} [{$field['name']}:{$field['key']}]\n";
                    }

                    $name = $field['name'];
                    $replaceCommentMeta($name);
                    $replacePostmeta($name);
                    $replaceTermmeta($name);
                    $replaceUsermeta($name);
                    $replaceOptions($name);
                }
            }
        }

        if ($run) {
            update_option('acf_link_migration_complete', true);
            printf('
                <h2>'.($migrated ? 'Migration already completed.' : 'Migration complete!').'</h2>
                <p>
                    <strong>You have successfully migrated your data, now please deactivate/delete the
                    <a href="%s">Advanced Custom Fields: Link</a> plugin. All link fields will be preserved.</strong>
                </p>
            ', admin_url('plugins.php'));
        } else {
            echo '</div>';
        }

        echo '</div>';
    }
}
