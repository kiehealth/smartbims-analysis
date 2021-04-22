<?php 

return [
    'admin' => 'Admin',
    'menu' => 'Menu',
    'dashboard' => 'Dashboard',
    'orders' => 'Orders',
    'kits' => 'Kits',
    'sample-results' => 'Sample Results',
    'Sample Results' => 'Sample Results',
    'users' => 'Users',
    'reports' => 'Reports',
    'Language' => 'Language',
    'Login' => 'Login',
    'Log out' => 'Log out',
    'Register' => 'Register',
    'Order' => 'Order',
    'Email' => 'Email',
    'Password' => 'Password',
    'Confirm Password' =>'Confirm Password',
    'Current Password' => 'Current Password',
    'New Password' => 'New Password',
    'Confirm New Password' => 'Confirm New Password',
    'Remember me' => 'Remember me',
    'Already registered?' => 'Already registered?',
    'Forgot your password?' => 'Forgot your password?',
    'Email Password Reset Link' => 'Email Password Reset Link',
    'Reset Password' => 'Reset Password',
    'back' => 'Back',
    'Back' => 'Back',
    'Cancel' => 'Cancel',
    'Upload' => 'Upload',
    'Choose file' => 'Choose file',
    'Import' => 'Import',
    'to-front' => 'To Front Website',
    'yyyy-mm-dd' => 'yyyy-mm-dd',
    
    'Whoops! Something went wrong.' => 'Whoops! Something went wrong.',
    'wrong-current-password' => 'Your current password does not match with the password you provided. Please provide the correct current password.',
    'password_update_success_msg' => 'Password updated successfully!',
    'Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.' => 'Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.',
    'Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.' => 'Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.',
    'A new verification link has been sent to the email address you provided during registration.' => 'A new verification link has been sent to the email address you provided during registration.',
    'Resend Verification Email' => 'Resend Verification Email',
    'I have read, agreed and want to order.' => 'I have read, agreed and want to order.',
    'I do not consent and do not wish to be contacted.' => 'I do not consent and do not wish to be contacted.',
    'click-button-to-order' => 'Order sampling material with return envelope and instructions by clicking on the button below.',
    'order-success-msg' => "Your order has been received and it will be sent
                             to your population registration address in a few days.
                             If you want it sent to another address or see
                             status, you can do so at <a style=\"
                             color: cornflowerblue;\" href=".url('/myprofile')."> my pages </a>
                             or contact us at hpvcenter@ki.se.",
    'click-button-to-withdraw-consent' => 'If you are sure you do not want to participate, you can do so by clicking the button below.',
    'regret-withdraw-consent' => 'If you revoke consent or end participation, we will not contact you again. However, if you regret it, you just need to
                                agree again on the website and order the self-sampling kit.',
    'end-participation' => 'End Participation',
    'unsubscribed-msg' => "Your participation in the study has ended and we will not contact you anymore. However, if you change your mind, you just need to
                            agree again on the <a style=\"color: cornflowerblue;\" href=".url('/')."> website homepage</a> and order self-sampling kit.",
    'profile' => 'My Profile',
    'change-password' => 'Change Password',
    'my-details' => 'My Details',
    'name' => 'Name',
    'ssn' => 'Social Security Number',
    'address' => 'Address',
    'check-edit' => 'Check/Edit',
    'edit-address' => 'Edit Address',
    'phonenumber' => 'Phone number',
    'street-number-apartment' => 'Street No., Apartment',
    'post-code' => 'Post Code',
    'town-city' => 'Town/City',
    'country' => 'Country',
    'select' => 'Select',
    'update' => 'Update',
    'cancel' => 'Cancel',
    'address-updated' => 'Address Updated',
    'my-orders' => 'My Orders',
    'no-orders' => 'No Orders',
    'latest' => 'Latest',
    'order-date' => 'Order Date',
    'status' => 'Status',
    'view-all' => 'View all',
    'test-results' => 'Test Results',
    'not-ready-yet' => 'Not ready yet',
    'result' => 'Result',
    'reporting-date' => 'Reporting Date',
    'sample-registered-date' => 'Sample Registered Date',
    'result-message' => 'Message',
    
    /*Kit Import*/
    'Import Kits/Samples' => 'Import Kits/Samples',
    'Use the excel/csv file template to import the kits.' => "Use the excel/csv <a href=".asset('storage/import_templates/kits_import_template.xlsx').">file template</a> to import the kits.",
    'order_id.required' => "Error on row: <strong>:row</strong>. The order_id is missing."
                                                  ." The order_id is required.",
    'order_id.exists' => "Error on row: <strong>:row</strong>. No order with order_id <strong>:order_id</strong> found. The order should be placed "
                                                ."before registering a kit.",
    'order_id.distinct' => "Error on row: <strong>:row</strong>. The order_id <strong>:order_id</strong> has a duplicate value. ".
                                                  " The order_id must be unique.",
    'sample_id.required_with' => "Error on row: <strong>:row</strong>. The sample_id is missing."
                                                  ." The sample_id is required when the sample_received_date is present.",
    'sample_id.distinct' => "Error on row: <strong>:row</strong>. The sample_id <strong>:sample_id</strong> has a duplicate value. ".
                                            " The sample_id must be unique.",
    'barcode.unique' => "Error on row: <strong>:row</strong>. The barcode <strong>:barcode</strong> has already been registered. The barcode must be unique.",
    'barcode.distinct' => "Error on row: <strong>:row</strong>. The barcode <strong>:barcode</strong> has a duplicate value. ".
                                            " The barcode must be unique.",
    'kit_dispatched_date.required' => "Error on row: <strong>:row</strong>. The kit_dispatched_date is missing.".
                                            " Please put the date when the kit is going to be dispatched.",
    'kit_dispatched_date.date' => "Error on row: <strong>:row</strong>. The kit_dispatched_date <strong>:kit_dispatched_date</strong> is not a valid date. 
                                                Please input a valid date (yyyy-mm-dd).",
    'sample_received_date.date' => "Error on row: <strong>:row</strong>. The sample_received_date <strong>:sample_received_date</strong> is not a valid date.
                                                Please input a valid date (yyyy-mm-dd).",
    'sample_received_date.required_with' => "Error on row: <strong>:row</strong>. The sample_received_date is missing."
                                                ." The sample_received_date is required when the sample_id is present.",
    'sample_received_date.after_or_equal' => "Error on row: <strong>:row</strong>. The sample_received_date <strong>:sample_received_date</strong> must be a date after or equal to kit_dispatched_date <strong>:kit_dispatched_date</strong>.",
    'kits_import_success_msg' => "<strong>:total</strong> Kits/Samples have been processed successfully! <br>
                            of which <strong>:insert</strong> Kits/Samples have been inserted and <strong>
                            :update</strong> Kits/Samples have been updated.",
    
     /*Sample Import*/
    'Import Samples/Results' => 'Import Samples/Results',
    'Use the excel/csv file template to import the samples.' => "Use the excel/csv <a href=".asset('storage/import_templates/samples_import_template.xlsx').">file template</a> to import the samples.",
    'cobas_analysis_date.required_with' => "Error on row: <strong>:row</strong>. The cobas_analysis_date is missing."
                                            ." The cobas_analysis_date is required when the cobas_result is present.",
    'cobas_result.in' => "Error on row: <strong>:row</strong>. The cobas_result <strong>:cobas_result</strong> is invalid. Only allowed one of the values <strong>:allowed</strong>.",
    'cobas_analysis_date.date' => "Error on row: <strong>:row</strong>. The cobas_analysis_date <strong>:cobas_analysis_date</strong> is not a valid date.
                                                Please input a valid date (yyyy-mm-dd).",
    'cobas_result.required_with' => "Error on row: <strong>:row</strong>. The cobas_result is missing."
                                        ." The cobas_result is required when the cobas_analysis_date is present.",
    'cobas_analysis_date.after_or_equal' => "Error on row: <strong>:row</strong>. The cobas_analysis_date <strong>:cobas_analysis_date</strong> must be a date after or equal to sample_registered_date <strong>:sample_registered_date</strong>.",
    'luminex_analysis_date.required_with' => "Error on row: <strong>:row</strong>. The luminex_analysis_date is missing."
                                            ." The luminex_analysis_date is required when the luminex_result is present.",
    'luminex_result.in' => "Error on row: <strong>:row</strong>. The luminex_result <strong>:luminex_result</strong> is invalid. Only allowed one of the values <strong>:allowed</strong>.",
    'luminex_analysis_date.date' => "Error on row: <strong>:row</strong>. The luminex_analysis_date <strong>:luminex_analysis_date</strong> is not a valid date.
                                                Please input a valid date (yyyy-mm-dd).",
    'luminex_result.required_with' => "Error on row: <strong>:row</strong>. The luminex_result is missing."
                                                ." The luminex_result is required when the luminex_analysis_date is present.",
    'luminex_analysis_date.after_or_equal' => "Error on row: <strong>:row</strong>. The luminex_analysis_date <strong>:luminex_analysis_date</strong> must be a date after or equal to sample_registered_date <strong>:sample_registered_date</strong>.",
    'rtpcr_analysis_date.required_with' => "Error on row: <strong>:row</strong>. The rtpcr_analysis_date is missing."
                                                        ." The rtpcr_analysis_date is required when the rtpcr_result is present.",
    'rtpcr_result.in' => "Error on row: <strong>:row</strong>. The rtpcr_result <strong>:rtpcr_result</strong> is invalid. Only allowed one of the values <strong>:allowed</strong>.",
    'rtpcr_analysis_date.date' => "Error on row: <strong>:row</strong>. The rtpcr_analysis_date <strong>:rtpcr_analysis_date</strong> is not a valid date.
                                                Please input a valid date (yyyy-mm-dd).",
    'rtpcr_result.required_with' => "Error on row: <strong>:row</strong>. The rtpcr_result is missing."
                                                ." The rtpcr_result is required when the rtpcr_analysis_date is present.",
    'rtpcr_analysis_date.after_or_equal' => "Error on row: <strong>:row</strong>. The rtpcr_analysis_date <strong>:rtpcr_analysis_date</strong> must be a date after or equal to sample_registered_date <strong>:sample_registered_date</strong>.",
    'reporting_date.required_with' => "Error on row: <strong>:row</strong>. The reporting_date is missing."
                                                        ." The reporting_date is required when the final_reporting_result is present.",
    'final_reporting_result.in' => "Error on row: <strong>:row</strong>. The final_reporting_result <strong>:final_reporting_result</strong> is invalid. Only allowed one of the values <strong>:allowed</strong>.",
    'reporting_date.date' => "Error on row: <strong>:row</strong>. The reporting_date <strong>:reporting_date</strong> is not a valid date.
                                                Please input a valid date (yyyy-mm-dd).",
    'final_reporting_result.required_with' => "Error on row: <strong>:row</strong>. The final_reporting_result is missing."
                                                ." The final_reporting_result is required when the reporting_date is present.",
    'reporting_date.after_or_equal' => "Error on row: <strong>:row</strong>. The reporting_date <strong>:reporting_date</strong> must be a date after or equal to sample_registered_date <strong>:sample_registered_date</strong>.",
    'kit_id.required' => "Error on row: <strong>:row</strong>. The kit_id is missing."
                                        ." The kit_id is required.",
    'kit_id.exists' => "Error on row: <strong>:row</strong>. No kit with kit_id <strong>:kit_id</strong> found. The kit should already be registered "
                                    ."before importing the sample.",
    'kit_id.distinct' => "Error on row: <strong>:row</strong>. The kit_id <strong>:kit_id</strong> has a duplicate value. ".
                                        " The kit_id must be unique.",
    'sample_id.required' => "Error on row: <strong>:row</strong>. The sample_id is missing."
                                        ." The sample_id is required.",
    'sample_id.distinct' => "Error on row: <strong>:row</strong>. The sample_id <strong>:sample_id</strong> has a duplicate value. ".
                                      " The sample_id must be unique.",
    'lab_id.distinct' => "Error on row: <strong>:row</strong>. The lab_id <strong>:lab_id</strong> has a duplicate value. ".
                                        " The lab_id must be unique.",
    'lab_id.unique' => "Error on row: <strong>:row</strong>. The lab_id <strong>:lab_id</strong> has already been registered. The lab_id must be unique.",
    'sample_registered_date.required' => "Error on row: <strong>:row</strong>. The sample_registered_date is missing."
                                        ." The sample_registered_date is required.",
    'sample_registered_date.date' => "Error on row: <strong>:row</strong>. The sample_registered_date <strong>:sample_registered_date</strong> is not a valid date.
                                                Please input a valid date (yyyy-mm-dd).",
    'samples_import_success_msg' => "<strong>:total</strong> Samples have been processed successfully! <br>
                            of which <strong>:insert</strong> Samples have been inserted and <strong>
                            :update</strong> Samples have been updated.",
    
    /*Report*/
    'Generate Report' => 'Generate Report',
    'search' => 'Search',
    'Orders' => 'Orders',
    'Unprocessed Orders' => 'Unprocessed Orders',
    'Without Orders' => 'Without Orders',
    'Kits' => 'Kits',
    'Kits Dispatched' => 'Kits Dispatched',
    'Kits/Samples Received' => 'Kits/Samples Received',
    'Samples' => 'Samples',
    'Results Reported' => 'Results Reported',
    'From Date' => 'From Date',
    'To Date' => 'To Date',
    
    /*User*/
    'edit-user' => 'Edit User',
    'update-user' => 'Update User',
    'Update User' => 'Update User',
    'delete-user' => 'Delete User',
    'user_updated_msg' => 'The user is updated!',
    'user_deleted_msg' => 'User Deleted!',
    'user_not_deleted_msg' => 'User cannot be deleted! Order already registered for the user. To delete
                                    the user, first delete the associated order.',
    'Are you sure you want to delete the user? All data related with the user will be deleted!' => 'Are you sure you want to delete the user? All data related with the user will be deleted!',
    
    /*Order*/
    'delete-order' => 'Delete Order',
    'Create Order' => 'Create Order',
    'Are you sure you want to delete the kit for this order?' => 'Are you sure you want to delete the kit for this order?',
    'Are you sure you want to delete the order?' => 'Are you sure you want to delete the order?',
    'order_deleted_msg' => 'Order Deleted!',
    'order_not_deleted_msg' => 'Order cannot be deleted! Kit already registered for the order. To delete
                                    the order, first delete the associated kit.',
    'order-success-msg-admin' => "Order created successfully for :ssn <strong>:ssnumber</strong>!",
    'order-unsuccess-msg-admin' => "The user with :ssn <strong>:ssnumber</strong> does not exist. Please register the user before you can place an order.",
    
    /*Kit*/
    'register-kit' => "Register Kit",
    'Register Kit' => "Register Kit",
    'register-kit-for-order-x' => 'Register Kit for order id :order_id',
    'Edit Kit' => "Edit Kit",
    'edit-kit-information' => 'Edit Kit Information',
    'edit-kit-for-order-x' => 'Edit Kit for order id :order_id',
    'delete-kit-for-order' => 'Delete Kit for this order',
    'delete-kit' => 'Delete Kit',
    'Are you sure you want to delete the kit?' => 'Are you sure you want to delete the kit?',
    'kit_for_order_updated_msg' => 'The Kit is updated for the order!',
    'kit_updated_msg' => 'The Kit is updated!',
    'kit_deleted_msg' => 'Kit Deleted!',
    'kit_not_deleted_msg' => 'Kit cannot be deleted! Sample already registered for the kit. To delete
                                    the kit, first delete the associated sample.',
    'kit_registered_msg' => 'The Kit is registered for the order!',
    
    /*Sample*/
    'Register Sample' => "Register Sample",
    'register-sample-for-order-x-kit-x' => 'Register Sample for order id :order_id/kit id :kit_id',
    'Are you sure you want to delete the sample?' => 'Are you sure you want to delete the sample?',
    'sample_registered_msg' => "The sample with sample_id <strong>:sample_id</strong> is registered successfully!",
    'Edit Sample Information' => 'Edit Sample Information',
    'Delete Sample' => 'Delete Sample',
    'edit-sample-for-order-x' => 'Edit Sample for order id :order_id',
    'Edit Sample' => "Edit Sample",
    'sample_updated_msg' => 'The Sample is updated!',
    'sample_deleted_msg' => 'Sample Deleted!',
    
    /*Dashboard*/
    'Dashboard' => 'Dashboard',
    'Participants and Orders' => 'Participants and Orders',
    'Total Participants' => 'Total Participants',
    'Participants with Orders' => 'Participants with Orders',
    'Participants without Orders' => 'Participants without Orders',
    'Total Orders' => 'Total Orders',
    'Orders Processed (Kits Registered)' => 'Orders Processed (Kits Registered)',
    'Orders Unprocessed (Kits Not Registered)' => 'Orders Unprocessed (Kits Not Registered)',
    'Total Kits Registered' => 'Total Kits Registered',
    'Kits Dispatched' => 'Kits Dispatched',
    'Samples Received' => 'Samples Received',
    'Samples and Results' => 'Samples and Results',
    'Total Samples Registered' => 'Total Samples Registered',
    'Results Reported' => 'Results Reported',
    'Results Not Reported' => 'Results Not Reported',
    
];
