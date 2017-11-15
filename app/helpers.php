<?php

const IMAGE_URL = '/storage/';

/*
 * Pages
 */
const URL_HOME = '/';
const URL_PRODUCT = '/product';
const URL_CATEGORY = '/category';
const URL_SERIES = '/series';
const URL_SHOP = '/shop';
const URL_ABOUT = '/about';

/*
 *
 */
const URL_USER_LOGIN = '/user/login';
const URL_USER_DO_LOGIN = '/user/do_login';
const URL_USER_LOGOUT = '/user/logout';

/*
 *   dashboard
 */
const URL_DASHBOARD = '/dashboard';

const URL_DASHBOARD_BANNER = '/dashboard/banner';
const URL_DASHBOARD_BANNER_DO_EDIT = '/dashboard/banner/do_edit';

const URL_DASHBOARD_HOTNEWS = '/dashboard/hotnews';
const URL_DASHBOARD_HOTNEWS_DO_EDIT = '/dashboard/hotnews/do_edit';

const URL_DASHBOARD_CATEGORY = '/dashboard/category';
const URL_DASHBOARD_CATEGORY_DO_EDIT = '/dashboard/category/do_edit';

const URL_DASHBOARD_SERIES = '/dashboard/series';
const URL_DASHBOARD_SERIES_DO_EDIT = '/dashboard/series/do_edit';

const URL_DASHBOARD_PRODUCT = '/dashboard/product';
const URL_DASHBOARD_PRODUCT_DO_EDIT = '/dashboard/product/do_edit';
const URL_DASHBOARD_PRODUCT_DO_ADD_MATERIAL = '/dashboard/product/do_add_material';

const URL_DASHBOARD_MATERIAL = '/dashboard/material';
const URL_DASHBOARD_MATERIAL_EDIT = '/dashboard/material/edit';
const URL_DASHBOARD_MATERIAL_DO_EDIT = '/dashboard/material/do_edit';

const URL_DASHBOARD_AUTHORITY_PRODUCT = '/dashboard/authority/user';
const URL_DASHBOARD_AUTHORITY_PRODUCT_EDIT = '/dashboard/authority/user/edit';
const URL_DASHBOARD_AUTHORITY_PRODUCT_DO_EDIT = '/dashboard/authority/user/do_edit';

const URL_DASHBOARD_PROFILE = '/dashboard/profile';
const URL_DASHBOARD_PROFILE_DO_PASSWORD_RESET = '/dashboard/profile/do_password_reset';

const URL_DASHBOARD_ELSE = '/dashboard/else';
const URL_DASHBOARD_ELSE_DO_UPDATE = '/dashboard/else/do_update';


/*
 *   dashboard2
 */
//const URL_DASHBOARD2 = '/dashboard2';

const URL_DASHBOARD2_BANNER = '/dashboard2/banner';
const URL_DASHBOARD2_BANNER_DO_DEL = '/dashboard2/banner/do_del';
const URL_DASHBOARD2_BANNER_DO_SAVE = '/dashboard2/banner/do_save';

const URL_DASHBOARD2_HOTNEWS = '/dashboard2/hotnews';
const URL_DASHBOARD2_HOTNEWS_DO_DEL = '/dashboard2/hotnews/do_del';
const URL_DASHBOARD2_HOTNEWS_DO_SAVE = '/dashboard2/hotnews/do_save';

const URL_DASHBOARD2_CATEGORY = '/dashboard2/category';
//const URL_DASHBOARD2_CATEGORY_DO_EDIT = '/dashboard2/category/do_edit';

const URL_DASHBOARD2_SERIES = '/dashboard2/series';
//const URL_DASHBOARD2_SERIES_DO_EDIT = '/dashboard2/series/do_edit';

const URL_DASHBOARD2_MATERIAL = '/dashboard2/material';
//const URL_DASHBOARD2_MATERIAL_EDIT = '/dashboard2/material/edit';
//const URL_DASHBOARD2_MATERIAL_DO_EDIT = '/dashboard2/material/do_edit';

const URL_DASHBOARD2_PRODUCT = '/dashboard2/product';
const URL_DASHBOARD2_PRODUCT_NEW = '/dashboard2/product/new';
const URL_DASHBOARD2_PRODUCT_DO_SAVE = '/dashboard2/product/do_save';
const URL_DASHBOARD2_PRODUCT_DO_DEL = '/dashboard2/product/do_del';
//const URL_DASHBOARD2_PRODUCT_DO_ADD_MATERIAL = '/dashboard2/product/do_add_material';

//const URL_DASHBOARD2_AUTHORITY_PRODUCT = '/dashboard2/authority/user';
//const URL_DASHBOARD2_AUTHORITY_PRODUCT_EDIT = '/dashboard2/authority/user/edit';
//const URL_DASHBOARD2_AUTHORITY_PRODUCT_DO_EDIT = '/dashboard2/authority/user/do_edit';

//const URL_DASHBOARD2_PROFILE = '/dashboard2/profile';
//const URL_DASHBOARD2_PROFILE_DO_PASSWORD_RESET = '/dashboard2/profile/do_password_reset';

//const URL_DASHBOARD2_ELSE = '/dashboard2/else';
//const URL_DASHBOARD2_ELSE_DO_UPDATE = '/dashboard2/else/do_update';


/*
 *   API
 */
const API_PRODUCT_IMAGES_GET = '/api/product/images/get';
const API_PRODUCT_IMAGES_UPLOAD = '/api/product/images/upload';
const API_PRODUCT_IMAGES_DELETE = '/api/product/images/delete';
const API_PRODUCT_IMAGES_RESORT = '/api/product/images/resort';

const API_BANNER_DO_DELETE = '/api/banner/do_delete';
const API_HOTNEWS_DO_DELETE = '/api/hotnews/do_delete';
const API_CATEGORY_DO_DELETE = '/api/category/do_delete';
const API_SERIES_DO_DELETE = '/api/series/do_delete';
const API_MATERIAL_DO_DELETE = '/api/material/do_delete';
const API_PRODUCT_DO_DELETE = '/api/product/do_delete';

const API_GET_MATERIAL_LIST_BY_PRODUCT = '/api/get/material_list';
const API_ADD_MATERIAL_LIST = '/api/add/material_list';
const API_MATERIAL_DO_DELETE_BY_PRODUCT = '/api/material/do_delete_by_product';