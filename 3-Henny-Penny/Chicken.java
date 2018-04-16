import java.util.*;
import java.io.*;

public class Chicken {
	
	private static int[][] grid = new int[100][100];
	private static List<String> pathList = new ArrayList<String>();
	
	public static void getPaths(int i, int j, String path, int size)
	{
		String temp = String.format("(%d,%d) -> ", i , j);
		if(!path.contains(temp))
			path += temp;
		else
			return;
		if( i == (size - 1) )
		{ 
			pathList.add(path);
		}
		else if( i > (size - 1) || i < 0 || j > (size - 1) || j < 0)
		{
			return;
		}
		else
		{
			if(i+1 < size)
			{
				if(grid[i+1][j] == 0)
					getPaths(i+1, j  , path, size);
			}
			if(j+1 < size)
			{
				if(grid[i][j+1] == 0)
					getPaths(i  , j+1, path, size);
			}
			if(j-1 >= 0)
			{
				if(grid[i][j-1] == 0)
					getPaths(i , j-1, path, size);
			}
			
		}	
			
	}
	
	public static void main(String[] args)
	{
		if(args.length != 1)
		{
			System.out.println("usage: java Chicken <filename>");
			System.exit(0);
		}
		File file = new File(args[0]);
		try
		{
			Scanner sc = new Scanner(file);
			int cnt = 0;
			int gridSize = 0;
			boolean flag = false;
			while(sc.hasNextLine())
			{
				String line = sc.nextLine();
				if(flag == false)
				{
					flag = true;
					gridSize = line.length();
					System.out.println(String.format("GRID SIZE = %dx%d\n", gridSize, gridSize));
					cnt = gridSize - 1;
				}
				for(int i = 0; i < gridSize; i++)
				{
					if(line.length() != gridSize)
					{
						System.out.println("Grid (in text file) is not a square.");
						System.exit(0);
					}
					if(line.charAt(i) == 'X')
					{	
						grid[i][cnt] = 1;
					}
					
					else if(line.charAt(i) == 'O')
					{
						grid[i][cnt] = 0;
					}
					else
					{
						System.out.println("Incorrect characters encountered. Check text file.");
						System.exit(0);
					}
				}
				cnt--;
			}
			for(int i = gridSize - 1; i >= 0; i--)
			{
				for(int j = 0; j < gridSize; j++)
				{
					if(grid[j][i] == 1)
						System.out.print("X");
					else
						System.out.print("O");
				}
				System.out.println();
			}
			Random rand = new Random();
			int starting = rand.nextInt(gridSize);
			while(grid[0][starting] == 1)
			{
				starting = rand.nextInt(gridSize);
			}
			getPaths(0, starting, "", gridSize);
			if(pathList.size() == 0)
			{
				System.out.println("No. of valid paths (listed below): 0");
				System.exit(0);
			}
			System.out.println(String.format("\nNo. of valid paths (listed below): %d\n", pathList.size()));
			for(int i = 0; i < pathList.size(); i++)
			{
				System.out.println(pathList.get(i).substring(0, pathList.get(i).length() - 3));
			}
				
		}
		catch(FileNotFoundException f)
		{
			System.out.println("Text file not found");
			System.exit(0);
		}
	}
}