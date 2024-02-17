import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import InputError from "@/Components/InputError";
import InputLabel from "@/Components/InputLabel";
import PrimaryButton from "@/Components/PrimaryButton";
import TextInput from "@/Components/TextInput";
import { Head, useForm, Link } from "@inertiajs/react";
// import { Inertia } from "@inertiajs/inertia";

export default function Edit({ auth, user }) {
    const { data, setData, put, processing, errors } = useForm({
        name: user.name || "",
        email: user.email || "",
        password: "", // Add the password field
        user_type: user.user_type || "",
    });

    const handleChange = (field, value) => {
        // Use a conditional to check if the field is 'password'
        if (field === 'password') {
            // Update the field in the form data, whether it's empty or not
            setData(field, value);
        } else {
            // For other fields, update the field in the form data only if the value is not empty
            if (value.trim() !== '') {
                setData(field, value);
            }
        }
    };


    const handleSubmit = (e) => {
        e.preventDefault();

        console.log("User ID:", user.id); // Check if user.id is defined

        Promise.resolve(put(route("admin.update", { id: user.id }), data))
            .then(() => {
                console.log("Successfully submitted the form");
            })
            .catch((error) => {
                console.error("Error submitting the form:", error);
            });
    };




    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Edit User
                </h2>
            }
        >
            <Head title="Edit User" />

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
                                onChange={(e) => setData("name", e.target.value)}
                                required
                            />
                            <InputError message={errors.name} className="mt-2" />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="email" value="Email" />
                            <TextInput
                                id="email"
                                name="email"
                                value={data.email}
                                className="mt-1 block w-full"
                                onChange={(e) => setData("email", e.target.value)}
                                required
                            />
                            <InputError message={errors.email} className="mt-2" />
                        </div>

                        <div className="mt-4">
                            <InputLabel htmlFor="password" value="Password" />
                            <TextInput
                                type="password"
                                id="password"
                                name="password"
                                value={data.password}
                                className="mt-1 block w-full"
                                onChange={(e) => handleChange("password", e.target.value)} // Update the password field in the form data conditionally
                            />
                            <InputError message={errors.password} className="mt-2" />
                        </div>



                        <div className="mt-4">
                            <InputLabel htmlFor="user_type" value="User Type" />
                            <select
                                id="user_type"
                                name="user_type"
                                value={data.user_type}
                                onChange={(e) => setData("user_type", e.target.value)}
                                className="mt-1 block w-full border-gray-300 rounded-md focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                required
                            >
                                {auth.user.user_type === 'superadmin' && (

                                    <>
                                        <option value="superadmin">Super Admin</option>
                                        <option value="admin">Admin</option>
                                        <option value="shopowner">Shop Owner</option>
                                        <option value="user">User</option>
                                    </>
                                )}
                                {auth.user.user_type !== 'superadmin' && (
                                    <>

                                        <option value="shopowner">Shop Owner</option>
                                        <option value="user">User</option>
                                    </>
                                )}
                            </select>
                            <InputError message={errors.user_type} className="mt-2" />
                        </div>




                        <div className="flex items-center justify-end mt-4">
                            <Link
                                href={route("admin.index")}
                                className="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                            >
                                Go to Users
                            </Link>

                            <PrimaryButton
                                className="ms-4"
                                disabled={processing}
                            >
                                Edit User
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
