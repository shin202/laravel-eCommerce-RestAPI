<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class UserPermissionsEnum extends Enum
{
    const ViewProducts = 0;
    const CreateProducts = 1;
    const EditProducts = 2;
    const DeleteProducts = 3;

    const ViewManufactures = 4;
    const CreateManufactures = 5;
    const EditManufactures = 6;
    const DeleteManufactures = 7;
    
    const ViewProductCategories = 8;
    const CreateProductCategories = 9;
    const EditProductCategories = 10;
    const DeleteProductCategories = 11;

    const ViewProductColors = 12;
    const CreateProductColors = 13;
    const EditProductColors = 14;
    const DeleteProductColors = 15;

    const ViewProductTypes = 16;
    const CreateProductTypes = 17;
    const EditProductTypes = 18;
    const DeleteProductTypes = 19;
    
    const ViewProductSizes = 20;
    const CreateProductSizes = 21;
    const EditProductSizes = 22;
    const DeleteProductSizes = 23;

    const PlaceOrder = 24;
    const ViewOrder = 25;
    const CheckingOrder = 26;
    const CancelOrder = 27;
    const DeleteOrder = 28;

    const ReadComments = 29;
    const WriteComments = 30;
    const EditComments = 31;
    const DeleteComments = 32;

    const Rating = 33;
    const EditRating = 34;
    const DeleteRating = 35;

    const ManageSystem = 36;
    const ManageUser = 37;
    const ManageAdmin = 38;
    const ManageAuthorize = 39;
}
