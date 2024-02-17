import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Head, useForm, Link } from "@inertiajs/react";

export default function Show({ auth, brand }) {

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Brand Details
                </h2>
            }
        >
            <Head title="Show Brands" />

            <div className="mt-4 flex sm:justify-center items-center bg-gray-100">
                <div className="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                    <form>
                        <div>
                            <InputLabel htmlFor="name" value="Name" />
                            <TextInput
                                id="name"
                                name="name"
                                value={brand.name}
                                className="mt-1 block w-full"
                                required
                                readOnly
                            />

                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="website" value="Website" />
                            <TextInput
                                id="website"
                                name="website"
                                value={brand.website}
                                className="mt-1 block w-full"
                                onChange={(e) =>
                                    setData("website", e.target.value)
                                }
                                readOnly
                            />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="contact" value="Contact" />
                            <TextInput
                                id="contact"
                                name="contact"
                                value={brand.contact}
                                className="mt-1 block w-full"
                                onChange={(e) =>
                                    setData("contact", e.target.value)
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
                            <TextInput
                                id="description"
                                name="description"
                                value={brand.description}
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
                                href={route("brands.index")}
                                className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Go to Brands
                            </Link>
                        </div>
                    </form>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
