import React, { useState } from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Head, useForm, Link } from "@inertiajs/react";

export default function Create({ auth, brand }) {
    const { data, setData, put, processing, errors } = useForm({
        name: brand.name || "",
        website: brand.website || "",
        contact: brand.contact || "",
        description: brand.description || "",
    });

    const handleSubmit = (e) => {
        e.preventDefault();

        put(route("brands.update", { brand: brand.id }));
    };

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Edit Brands
                </h2>
            }
        >
            <Head title="Edit Brand" />

            <div className="mt-4 flex sm:justify-center items-center bg-gray-100">
                <div className="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <form onSubmit={handleSubmit}>
                        <div>
                            <InputLabel htmlFor="name" value="Name" />
                            <TextInput
                                id="name"
                                name="name"
                                value={data.name}
                                className="mt-1 block w-full"
                                onChange={(e) =>
                                    setData("name", e.target.value)
                                }
                                required
                            />
                            <InputError
                                message={errors.name}
                                className="mt-2"
                            />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="website" value="Website" />
                            <TextInput
                                id="website"
                                name="website"
                                value={data.website}
                                className="mt-1 block w-full"
                                onChange={(e) =>
                                    setData("website", e.target.value)
                                }
                            />
                            <InputError
                                message={errors.website}
                                className="mt-2"
                            />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="contact" value="Contact" />
                            <TextInput
                                id="contact"
                                name="contact"
                                value={data.contact}
                                className="mt-1 block w-full"
                                onChange={(e) =>
                                    setData("contact", e.target.value)
                                }
                                required
                            />
                            <InputError
                                message={errors.contact}
                                className="mt-2"
                            />
                        </div>

                       

                        <div className="mt-4">
                            <InputLabel
                                htmlFor="description"
                                value="Description"
                            />
                            <TextInput
                                id="description"
                                name="description"
                                value={data.description}
                                className="mt-1 block w-full"
                                onChange={(e) =>
                                    setData("description", e.target.value)
                                }
                                required
                            />
                            <InputError
                                message={errors.description}
                                className="mt-2"
                            />
                        </div>

                        <div className="flex items-center justify-end mt-4">
                            <Link
                                href={route("brands.index")}
                                className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Go to Brands
                            </Link>

                            <PrimaryButton
                                className="ms-4"
                                disabled={processing}
                            >
                                Edit Brands
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
