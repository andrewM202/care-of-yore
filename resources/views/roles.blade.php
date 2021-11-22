<x-app-layout>
    <body>
        <div id='roles'>
            <table class='table-auto'>
                <thead>
                    <tr class='text-md font-semibold text-left text-gray-900 bg-gray-100 border-b border-gray-600'>
                        <th>Role</th>
                        <th>Access Level</th>
                    </tr>
                </thead>
                <tbody class='bg-white'>
                    <tr class='text-gray-700'>
                        <td>Admin</td>
                        <td>0</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <form method="POST">
            <div id='roleCreation'>
                <label for='newRole'>New Role</label>
                <input type='text' placeholder='Patient' name='newRole' class=''>
                <label for='accessLevel'>Access Level</label>
                <input type='number' placeholder='5' min="0" name='accessLevel'>
            </div>
            <button type="submit" class='p-3 border border-gray-700'>Ok</button>
            <button type="reset" class='p-3 border border-gray-700'>Cancel</button>
        </form>
    </body>
</x-app-layout>
