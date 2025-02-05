import React, { useState } from 'react';
import { router } from '@inertiajs/react';

export default function Edit({ table, tableNo }) {
    // สถานะเพื่อจัดการตารางที่เลือก
    const [selectedTable, setSelectedTable] = useState(tableNo || 1);

    // สถานะเพื่อจัดการคำค้นหา
    const [searchQuery, setSearchQuery] = useState('');

    // สถานะเพื่อจัดการข้อมูลที่กำลังแก้ไข
    const [editData, setEditData] = useState(null);

    // กำหนดคอลัมน์สำหรับแต่ละตาราง
    const columns = {
        1: [
            { label: 'ID', key: 'id' },
            { label: 'Course Code', key: 'course_code' },
            { label: 'Course Name', key: 'course_name' },
            { label: 'Teacher ID', key: 'teacher_id' },
        ],
        2: [
            { label: 'ID', key: 'id' },
            { label: 'Student ID', key: 'student_id' },
            { label: 'Name', key: 'name' },
            { label: 'Age', key: 'age' },
            { label: 'Major', key: 'major' },
        ],
        3: [
            { label: 'ID', key: 'id' },
            { label: 'Teacher Name', key: 'name' },
            { label: 'Department', key: 'department' },
        ],
        4: [
            { label: 'ID', key: 'id' },
            { label: 'Student ID', key: 'student_id' },
            { label: 'Course ID', key: 'course_id' },
            { label: 'Semester', key: 'semester' },
        ]
    };

    // ฟังก์ชันจัดการการเปลี่ยนหน้าในการแบ่งหน้า
    const handlePageChange = (url, selectedTable) => {
        router.get(url, { selectedTable, search: searchQuery });
    };

    // ฟังก์ชันจัดการการเปลี่ยนตาราง
    const handleTableChange = (newTable) => {
        setSelectedTable(newTable);
        handlePageChange('/registers/edit', newTable);
    };

    // ฟังก์ชันจัดการการค้นหา
    const handleSearch = (e) => {
        e.preventDefault();
        handlePageChange('/registers/edit', selectedTable);
    };

    // ฟังก์ชันจัดการการลบข้อมูล
    const handleDelete = (id) => {
        if (confirm('Are you sure you want to delete this record?')) {
            router.delete(`/registers/${id}`, {
                onSuccess: () => handlePageChange('/registers/edit', selectedTable)
            });
        }
    };

    // ฟังก์ชันจัดการการแก้ไขข้อมูล
    const handleEdit = (row) => {
        setEditData(row);
    };

    // ฟังก์ชันจัดการการบันทึกข้อมูลที่แก้ไข
    const handleSave = (e) => {
        e.preventDefault();
        let url = `/registers/${editData.id}`;
        router.patch(url, editData, {
            onSuccess: () => {
                setEditData(null);
                handlePageChange('/registers/edit', selectedTable);
            }
        });
    };

    // ฟังก์ชันจัดการการเปลี่ยนแปลงข้อมูลในฟอร์มแก้ไข
    const handleChange = (e) => {
        const { name, value } = e.target;
        setEditData({
            ...editData,
            [name]: value
        });
    };

    // ฟังก์ชันจัดการการออกจากหน้าแก้ไข
    const handleExit = () => {
        router.get('/registers');
    };

    return (
        <div className="p-16">
            <div className="flex justify-between items-center mb-8">
                <h1 className="text-3xl font-bold">Edit Menu</h1>
                <div className="flex space-x-4">
                    {/* ปุ่มสำหรับเปลี่ยนตาราง */}
                    <button
                        onClick={() => handleTableChange(1)}
                        className={`px-4 py-2 rounded ${selectedTable === 1 ? 'bg-blue-700 text-white' : 'bg-gray-300 text-gray-800'}`}
                    >
                        Course
                    </button>
                    <button
                        onClick={() => handleTableChange(2)}
                        className={`px-4 py-2 rounded ${selectedTable === 2 ? 'bg-blue-700 text-white' : 'bg-gray-300 text-gray-800'}`}
                    >
                        Student
                    </button>
                    <button
                        onClick={() => handleTableChange(3)}
                        className={`px-4 py-2 rounded ${selectedTable === 3 ? 'bg-blue-700 text-white' : 'bg-gray-300 text-gray-800'}`}
                    >
                        Teacher
                    </button>
                    <button
                        onClick={() => handleTableChange(4)}
                        className={`px-4 py-2 rounded ${selectedTable === 4 ? 'bg-blue-700 text-white' : 'bg-gray-300 text-gray-800'}`}
                    >
                        Register
                    </button>
                </div>
            </div>
            <div className="flex justify-end items-center mb-8 space-x-4">
                {/* ฟอร์มค้นหา */}
                <form onSubmit={handleSearch} className="flex space-x-2">
                    <input
                        type="text"
                        value={searchQuery}
                        onChange={(e) => setSearchQuery(e.target.value)}
                        placeholder="Search..."
                        className="px-4 py-2 border rounded"
                    />
                    <button type="submit" className="px-4 py-2 bg-blue-500 text-white rounded">Search</button>
                </form>
            </div>
            <table className="min-w-full bg-white border border-gray-300">
                <thead className="bg-blue-500 text-white">
                    <tr>
                        {columns[selectedTable].map((column) => (
                            <th key={column.key} className="py-2 px-4 border-b border-gray-400">{column.label}</th>
                        ))}
                        <th className="py-2 px-4 border-b border-gray-400">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {table.data.map((row) => (
                        <tr key={row.id} className="even:bg-gray-100">
                            {columns[selectedTable].map((column) => (
                                <td key={column.key} className="py-2 px-4 border-b border-gray-400 text-center">
                                    {editData && editData.id === row.id ? (
                                        <input
                                            type="text"
                                            name={column.key}
                                            value={editData[column.key]}
                                            onChange={handleChange}
                                            className="w-full px-3 py-2 border rounded"
                                        />
                                    ) : (
                                        row[column.key]
                                    )}
                                </td>
                            ))}
                            <td className="py-2 px-4 border-b border-gray-400 text-center">
                                {editData && editData.id === row.id ? (
                                    <button
                                        onClick={handleSave}
                                        className="px-2 py-1 bg-green-500 text-white rounded mr-2"
                                    >
                                        Save
                                    </button>
                                ) : (
                                    <button
                                        onClick={() => handleEdit(row)}
                                        className="px-2 py-1 bg-yellow-500 text-white rounded mr-2"
                                    >
                                        Edit
                                    </button>
                                )}
                                <button
                                    onClick={() => handleDelete(row.id)}
                                    className="px-2 py-1 bg-red-500 text-white rounded"
                                >
                                    Delete
                                </button>
                            </td>
                        </tr>
                    ))}
                </tbody>
            </table>
            <div className="mt-8 flex justify-center items-center space-x-4">
                <button
                    onClick={() => handlePageChange(`${table.prev_page_url}`, selectedTable)}
                    disabled={!table.prev_page_url}
                    className="px-4 py-2 bg-blue-500 text-white rounded disabled:opacity-50"
                >
                    Previous
                </button>
                <span className="text-lg">Page {table.current_page} of {table.last_page}</span>
                <button
                    onClick={() => handlePageChange(`${table.next_page_url}`, selectedTable)}
                    disabled={!table.next_page_url}
                    className="px-4 py-2 bg-blue-500 text-white rounded disabled:opacity-50"
                >
                    Next
                </button>
            </div>
            <div className="fixed bottom-4 right-4">
                <button
                    onClick={handleExit}
                    className="px-4 py-2 bg-red-500 text-white rounded"
                >
                    Exit
                </button>
            </div>
        </div>
    );
}
