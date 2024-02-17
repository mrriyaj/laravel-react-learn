import React from "react";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import axios from "axios";

export default function BrandIndex({ auth, brands: initialBrands }) {
    const [brands, setBrands] = React.useState(initialBrands);

    return (
        <AuthenticatedLayout
            user={auth.user}
            header={<h2 className="font-semibold text-xl text-gray-800 leading-tight">Brand Management System</h2>}
        >
            <Head title="Brands" />

            <div className="py-6">
                <div className="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div className="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <div className="flex items-center justify-end mt-1 mb-2">
                                {/* Add New Brand link */}
                                {auth.user && auth.user.can('create_brand') && (
                                    <Link className="ms-4" href={route("brands.create")}>
                                        Add New Brand
                                    </Link>
                                )}
                            </div>

                            <table className="items-center bg-transparent w-full border-collapse">
                                <thead>
                                    <tr>
                                        <th className="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Brand Name
                                        </th>
                                        <th className="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Website
                                        </th>
                                        <th className="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Contact No
                                        </th>

                                        <th className="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Description
                                        </th>
                                        <th className="px-6 bg-blueGray-50 text-blueGray-500 align-middle border border-solid border-blueGray-100 py-3 text-xs uppercase border-l-0 border-r-0 whitespace-nowrap font-semibold text-left">
                                            Action
                                        </th>
                                    </tr>
                                </thead>

                                <tbody>
                                    {brands.map((brand) => (
                                        <tr key={brand.id}>
                                            <td className="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4 text-left text-blueGray-700">
                                                {brand.name}
                                            </td>
                                            <td className="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                {brand.website}
                                            </td>
                                            <td className="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                {brand.contact}
                                            </td>
                                            <td className="border-t-0 px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                {brand.description}
                                            </td>
                                            <td className="border-t-0 flex px-6 align-middle border-l-0 border-r-0 text-xs whitespace-nowrap p-4">
                                                {/* Show link */}
                                                {auth.user && auth.user.can('view_brand', brand) && (
                                                    <Link href={route("brands.show", { brand: brand.id })}>
                                                        Show
                                                    </Link>
                                                )}
                                                {/* Edit link */}
                                                {auth.user && auth.user.can('update_brand', brand) && (
                                                    <Link href={route("brands.edit", { brand: brand.id })}>
                                                        Edit
                                                    </Link>
                                                )}
                                                {/* Delete button */}
                                                {auth.user && auth.user.can('delete_brand', brand) && (
                                                    <form
                                                        onSubmit={(e) => {
                                                            e.preventDefault();
                                                            axios.delete(route('brands.destroy', { brand: brand.id })).then(() => {
                                                                setBrands(brands.filter(p => p.id !== brand.id));
                                                            });
                                                        }}
                                                    >
                                                        <button type="submit">
                                                            Delete
                                                        </button>
                                                    </form>
                                                )}
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
