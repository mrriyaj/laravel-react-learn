import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Head, useForm, Link } from "@inertiajs/react";
import { Inertia } from "@inertiajs/inertia";
import TextArea from "@/Components/TextArea";

export default function Show({ auth, product, category, brand }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Product Details
                </h2>
            }
        >
            <Head title="Show Products" />

            <div className="mt-4 flex sm:justify-center items-center bg-gray-100">
                <div className="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <form>
                        <div>
                            <InputLabel htmlFor="name" value="Name" />
                            <TextInput
                                id="name"
                                name="name"
                                value={product.name}
                                className="mt-1 block w-full"
                                readOnly
                            />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="brand_id" value="Brand ID" />
                            <TextInput
                                className="mt-1 block w-full"
                                value={brand ? brand.name : "N/A"}
                            />
                        </div>

                        <div className="mt-4">
                            <InputLabel
                                htmlFor="category_id"
                                value="Category ID"
                            />
                            <TextInput
                                className="mt-1 block w-full"
                                value={category ? category.name : "N/A"}
                            />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="price" value="Price" />
                            <TextInput
                                id="price"
                                name="price"
                                value={product.price}
                                className="mt-1 block w-full"
                                onChange={(e) =>
                                    setData("price", e.target.value)
                                }
                                readOnly
                                required
                            />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="unit" value="Unit" />
                            <TextInput
                                id="unit"
                                name="unit"
                                value={product.unit}
                                className="mt-1 block w-full"
                                onChange={(e) =>
                                    setData("unit", e.target.value)
                                }
                                readOnly
                                required
                            />
                        </div>
                        <div className="mt-4">
                            <InputLabel htmlFor="size" value="Size" />
                            <TextInput
                                id="size"
                                name="size"
                                value={product.size}
                                className="mt-1 block w-full"
                                onChange={(e) =>
                                    setData("size", e.target.value)
                                }
                                readOnly
                                required
                            />
                        </div>

                        <div className="mt-4">
                            <InputLabel
                                htmlFor="description"
                                value="Description"
                            />
                            <TextArea
                                id="description"
                                name="description"
                                value={product.description}
                                className="mt-1 block w-full"
                                onChange={(e) =>
                                    setData("description", e.target.value)
                                }
                                readOnly
                                required
                            />
                        </div>

                        <div className="items-center justify-end mt-4">
                            <Link
                                href={route("products.index")}
                                className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Go to Products
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
